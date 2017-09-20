<?php
/**
 */

namespace Db19\Repositories;

use Carbon\Carbon;
use Db19\ModelsDb\Control;
use Db19\ModelsDb\Document;
use Db19\ModelsDb\Resolution;
use Validator;
use Illuminate\Http\Request;
use Db19\ModelsApp\OrderColumn;
use Db19\ModelsApp\Type;
use Db19\ModelsDb\Registration;
use Db19\ModelsDb\Appendix;
use Db19\ModelsDb\DocBody;

/**
 * Class CreateDocRepository
 *
 * @package Db19\Repositories
 */
class CreateDocRepository extends Repository
{
    private $columnSort;// = 'documents.updated_at';

    private $directionSort;// = 'desc'; //asc

    private $orderColumn;

    private $asideTemplate = 'writer.aside_menu';

    private $draftsTemplate = 'writer.drafts';

    /**
     * CreateDocRepository constructor.
     *
     * @param Type        $type
     * @param OrderColumn $orderColumn
     */
    public function __construct(Type $type, OrderColumn $orderColumn)
    {
        parent::__construct($type);

        $this->orderColumn = $orderColumn;
    }

    public function viewChecks()
    {

        return true;
    }

    public function viewPrepares()
    {
        return true;
    }


    /**
     * @param Document $doc
     *
     * @return string        Returns Native Name of documents.
     */
    public function getNativeTypeName(Document $doc)
    {
        $typeName = Registration::whereDocumentId($doc->id)->first()->type_name;
        $this->model = Type::find($typeName);
        $nativeTypeName = str_replace('\n', "<br>", $this->getInstance()->native_name);

        return $nativeTypeName;
    }



    /**
     * @param Request $request
     * @param         $type string The document type. It stored in registrations.type_name.
     *
     * @return string
     */
    public function viewDrafts(Request $request, $type)
    {
        if (view()->exists($this->draftsTemplate)) {
            $orderColumns = $this->getAllOrders($type);
            $allColumnName = $this->model->where('name', $type)->get()[0];

            if ($request->has('activeColumn')) {
                $sortBy = in_array($request->activeColumn, $orderColumns) ? $request->activeColumn : false;
            } else {
                $sortBy = false;
            }

            $data['allColumnName'] = $allColumnName;
            $data['orders'] = $orderColumns;

            $drafts = $this->getDrafts($request, $type, $sortBy);

            $data['view_drafts'] = $drafts;
            $data['type'] = $type;
            $data['columnSort'] = $request->has('glyphSort') ? $request->glyphSort : $sortBy;
            $data['directionSort'] = $this->directionSort;

            return view($this->draftsTemplate, $data)->render();
        }

        abort(404);
    }

    /**
     * This method take drafts in the database.
     *
     * @param Request $request
     * @param string         $type   This param is a type name of documents in registrations table.
     * @param bool|string    $sortBy This param indicate sorting direction.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getDrafts(Request $request, $type, $sortBy = false)
    {
        $this->changeDirectionSelect($request, $sortBy);
        return $this->getSortedDrafts($type);
    }

    /**
     * @param string $type
     * @param string $state
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @internal param Request $request
     */
    private function getSortedDrafts($type, $state = 'draft')
    {
        $userId = \Auth::user()->id;

        $select[] = 'documents.id';
        $drafts[] = 'documents.updated_at';
        $orders = $this->getAllOrders($type);
        foreach ($orders as $key) {
            $select[] = $this->getFullColumnName($key);
        }

        $drafts = \DB::connection('mysql_input_doc')
            ->table('documents')
            ->join('registrations', 'documents.id', '=', 'registrations.document_id')
            ->select($select)
            ->orderBy($this->columnSort, $this->directionSort)
            ->where('hard_deletion', '=', true)
            ->where('documents.creator_id', '=', $userId)
            ->where('registrations.type_name', '=', $type)
            ->where('state_name', '=', $state)
            ->paginate(\Config::get('db19.paginate'));

        return $drafts;
    }

    /**
     * This method returns the column name in format TABLE.COLUMN
     *
     * @param string $name The column name in the table DOCUMENTS or REGISTRATIONS
     *
     * @return string
     */
    private function getFullColumnName($name)
    {
        switch ($name) {
            case 'num':
                return 'registrations.num';

            case 'date':
                return 'registrations.date';

            case 'type_name':
                return 'registrations.type_name';

            case 'return_date':
                return 'documents.return_date';

            case 'author':
                return 'documents.author';

            case 'header':
                return 'documents.header';

            case 'key_words':
                return 'documents.key_words';

            case 'description':
                return 'documents.description';

            case 'number_of_copies':
                return 'documents.number_of_copies';

            case 'number_of_pages':
                return 'documents.number_of_pages';

            case 'description_copy':
                return 'documents.description_copy';

            case 'number_of_appendix':
                return 'documents.number_of_appendix';

            case 'number_of_pages_appendix':
                return 'documents.number_of_pages';

            case 'case_number':
                return 'documents.case_number';

            case 'page_in_case':
                return 'documents.page_in_case';

            case 'relation_document':
                return 'documents.relation_document';

            case 'creator_id':
                return 'documents.creator_id';

            case 'state_name':
                return 'documents.state_name';

            case 'outside_num':
                return 'documents.outside_num';

            case 'outside_date':
                return 'documents.outside_date';

            case 'correspondent':
                return 'documents.correspondent';
        }
    }

    /**
     * This method changes ore sets column and direction to select drafts.
     *
     * @param Request $request
     * @param         $sortBy string Column name to sort drafts.
     *
     * @return void
     */
    private function changeDirectionSelect(Request $request, $sortBy)
    {
        $sortBy = $this->getFullColumnName($sortBy);

        if ($request->session()->has('draftsSort')) {
            $this->columnSort = $request->session()->get('draftsSort');
        } else {
            $this->columnSort = 'documents.updated_at';
        }
        if ($request->session()->has('directionDrafts')) {
            $this->directionSort = $request->session()->get('directionDrafts');
        } else {
            $this->directionSort = 'desc';
        }

        if ($this->columnSort === $sortBy) {
            $this->directionSort = (($this->directionSort === 'asc') ? 'desc' : 'asc');
            $request->session()->put('directionDrafts', $this->directionSort);
        } else {
            if ($sortBy) {
                $this->columnSort = $sortBy;
            }
            $request->session()->put('draftsSort', $this->columnSort);
            $request->session()->put('directionDrafts', $this->directionSort);
        }
    }

    /**
     * This method deletes record in documents table.
     *
     * @param $document_id
     *
     * @return bool|null
     */
    public function deleteDoc($document_id)
    {
        $doc = Document::find($document_id);
        if ($doc->hard_deletion) {
            return $doc->forceDelete();
        }
        return $doc->delete();
    }

    /**
     * This method deletes record in registrations table.
     *
     * @param $document_id
     *
     * @return bool|null
     */
    public function deleteReg($document_id)
    {
        return Registration::where('document_id', $document_id)->delete();
    }

    /**
     * This method deletes record in doc_bodies table.
     *
     * @param $document_id
     *
     * @return bool|null
     */
    public function deleteDocBody($document_id)
    {
        return DocBody::where('document_id', $document_id)->delete();
    }

    /**
     * This method deletes the all Appendix models
     *
     * @param $document_id
     *
     * @return bool|mixed|null
     */
    public function deleteAppendices($document_id)
    {
        return Appendix::whereDocumentId($document_id)->delete();
    }

    /**
     * This method deletes the all Control models
     *
     * @param $document_id
     *
     * @return bool|mixed|null
     */
    public function deleteControls($document_id)
    {
        return Control::whereDocumentId($document_id)->delete();
    }

    /**
     * This method deletes the all Resolution models
     *
     * @param $document_id
     *
     * @return bool|mixed|null
     */
    public function deleteResolutions($document_id)
    {
        return Resolution::whereDocumentId($document_id)->delete();
    }

    /**
     * This method creates a records with blob appendix for document
     *
     * @param Request $request
     * @param         $docId
     *
     * @return string
     */
    public function insertAppendices(Request $request, $docId)
    {
        $appendices = $request->file('appendices');
        foreach ($appendices as $appendix) {
            if ($appendix->isValid()) {
                $prepareAppendix = new Appendix();
                $prepareAppendix->document_id = $docId;
                $prepareAppendix->appendix = file_get_contents($appendix->getRealPath());
                $prepareAppendix->original_name = $appendix->getClientOriginalName();
                $prepareAppendix->mime_type = $appendix->getClientMimeType();
                $prepareAppendix->size = $appendix->getSize();

                $prepareAppendix->save();
            } else {
                return redirect()->back()->with('error', trans('ua.errorUploadsAppendices'));
            }
        }
    }

    /**
     * This method puts the document body in the database.
     *
     * @param Request $request
     * @param         $docId
     *
     * @return string
     */
    public function insertBody(Request $request, $docId)
    {
        if (($request->hasFile('doc_body')) && ($request->file('doc_body')->isValid())) {
            $docBody = $request->file('doc_body');
            $prepareBody = new DocBody();
            $prepareBody->document_id = $docId;
            $prepareBody->appendix = file_get_contents($docBody->getRealPath());
            $prepareBody->original_name = $docBody->getClientOriginalName();
            $prepareBody->mime_type = $docBody->getClientMimeType();
            $prepareBody->size = $docBody->getSize();

            $prepareBody->save();
            return;
        } else {
            return redirect()->back()->with('error', trans('ua.ErrorInsertDocumentBody'));
        }
    }

    /**
     * This method inserts data into Registrations table.
     *
     * @param $data array
     */
    public function insertReg($data)
    {
        $reg = new Registration($data);
        $reg->save();
    }

    /**
     * This method prepares the data to be written to registrations table.
     *
     * @param Request $request
     * @param         $id integer This is a primary key of document.
     *
     * @return array
     */
    public function prepareRegData(Request $request, $id)
    {
        $data = $request->only(['type_name', 'num', 'date']);
        $data['document_id'] = $id;

        return $data;
    }

    /**
     * This method inserts data into the Documents table.
     *
     * @param $data array this data will be insert into table documents
     *
     * @return int number of primary key
     */
    public function insertDoc($data)
    {
        $id = \DB::connection('mysql_input_doc')
            ->table('documents')
            ->insertGetId($data);

        return $id;
    }

    /**
     * This method prepares the data to be written to the documents table.
     *
     * @param Request $request
     *
     * @return array
     */
    public function prepareDataDoc(Request $request)
    {
        $data = $request->except(['_token', 'num', 'date', 'type_name', 'doc_body', 'appendices']);
        $data['creator_id'] = \Auth::user()->id;
        $data['state_name'] = 'draft';
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        return $data;
    }

    /**
     * This method checks the type of document
     *
     * @param $document_type
     *
     * @return string
     */
    public function verifyType($document_type)
    {
        $allTypeNames = $this->model->pluck('name');

        foreach ($allTypeNames as $type) {
            if ($type === $document_type) {
                return $document_type;
            }
        }

        $defaultNumType = \Config::get('db19.startBook');

        if ($defaultNumType >= count($allTypeNames)) {
            return $allTypeNames[0];
        }
        return $allTypeNames[$defaultNumType];
    }

    /**
     * This method get all Types of Document in App
     *
     * @return \Illuminate\Database\Eloquent\Collection of Db19\ModelsApp\Type
     */
    public function getAllTypes()
    {
        $types = $this->model->all();

        return $types;
    }

    /**
     * @param $type string Type of document to be created
     *
     * @param $routeName string The name of the route to create a link in Asidemenu.
     *
     * @return string
     */
    public function createAside($type, $routeName)
    {
        if (view()->exists($this->asideTemplate)) {
            $data =[];
            $types = $this->getAllTypeName();
            $data['types'] = $types;
            $data['defaultType'] = $type;
            $data['routeName'] = $routeName;

            return view('writer.aside_menu', $data)->render();
        }

        abort(404);
    }

    /**
     * This method creates a menu of the right sidebar
     *
     * @param $routeName string The name of the route to create a link in menu_panel.
     *
     * @return string
     */
    public function createMenuPanel($routeName)
    {
        if (view()->exists('writer.menu_panel')) {
            return view('writer.menu_panel', ['routeName' => $routeName])->render();
        }

        abort(404);
    }

    /**
     * This method creates a form for creating a record in the database
     *
     * @param $type
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createForm($type)
    {
        if (view()->exists('writer.form_create_doc')) {
            $orderColumns = $this->getAllOrders($type);
            $allColumnName = $this->model->where('name', $type)->get()[0];
            return view('writer.form_create_doc', ['allColumnName' => $allColumnName, 'orders' => $orderColumns]);
        }

        abort(404);
    }


    /**
     * @param Request  $request
     * @param Document $draft
     *
     * @return string
     */
    public function editFieldsDraft(Request $request, Document $draft)
    {
        if (view()->exists('writer.draft_edit_form')) {
            $draftId = $draft->id;
            $request->session()->flash('draftId', $draftId);
            $reg = Registration::whereDocumentId($draftId)->get()->last();//first();
            $request->session()->flash('type_name', $reg->type_name);
            $orderColumns = $this->getAllOrders($reg->type_name);
            $orderColumns[] = 'id';
            $allColumnName = $this->model->where('name', $reg->type_name)->get()[0];

            $prepareData = [];
            foreach ($orderColumns as $column) {
                if (($column === 'num') || ($column === 'date') || ($column === 'type_name')) {
                    continue;
                }
                $prepareData[$column] = $draft->$column;
            }
            $prepareData['num'] = $reg->num;
            $prepareData['date'] = $reg->date;
            $prepareData['type_name'] = $reg->type_name;

            $data['orders'] = $orderColumns;
            $data['allColumnName'] = $allColumnName;
            $data['prepareData'] = $prepareData;

            return view('writer.draft_edit_form', $data)->render();
        }

        abort(404);
    }

    /**
     * @param Document $draft
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewBodyInfo(Document $draft)
    {
        if (view()->exists('writer.body_info')) {
            $body = DocBody::whereDocumentId($draft->id)->get();
            $appendices = Appendix::whereDocumentId($draft->id)->get();
            $data['draftId'] = $draft->id;
            $data['body'] = $body;
            $data['appendices'] = $appendices;

            return view('writer.body_info', $data)->render();
        }
        abort(404);
    }

    /**
     * @param Document $draft
     *
     * @return string
     */
    public function viewControlAndResolution(Document $draft)
    {
        if (view()->exists('writer.control_info')) {
            $controls = Control::whereDocumentId($draft->id)->get();
            $resolutions = Resolution::whereDocumentId($draft)->get();
            $data['draftId'] = $draft->id;
            $data['controls'] = $controls;
            $data['resolutions'] = $resolutions;
            return view('writer.control_info', $data)->render();
        }
        abort(404);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getAllTypeName()
    {
        return $this->model->select('name', 'alias', 'native_name')->get();
    }

    /**
     * This method returns an array with column sorted like as in directive template
     *
     * @param $type string <This is a document type>
     *
     * @return array
     */
    private function getAllOrders($type)
    {
        $orders = $this->orderColumn->where('type_name', $type)->first();

        $column = $orders->toArray();
        array_shift($column);
        $columnFiltered = array_flip(array_filter($column, function ($val) {
            return (!is_null($val));
        }));
        ksort($columnFiltered);

        return $columnFiltered;
    }

    /**
     * This method validates the input data
     *
     * @param Request $request
     *
     * @return $this|bool
     */
    public function validateInput(Request $request)
    {
        $rules = $this->createRule($request->type_name);

        $validator = Validator::make($request->all(), $rules/*, $messages*/);

        if ($validator->fails()) {
            return redirect()
//                ->route('create_doc', ['document_type' => $request->type_name])
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        return false;
    }

    /**
     * This method creates validation rules for the input data.
     *
     * @param $type_name
     *
     * @return mixed
     */
    private function createRule($type_name)
    {
        $columns = $this->getAllOrders($type_name);

        $allRules = [
            'num' => 'required',
            'date' => 'required|date',
            'author' => 'required|string',
            'header' => 'required|string',
            'key_words' => 'required|string',
            'description' => 'string|nullable',
            'number_of_copies' => 'required|integer|min:1',
            'number_of_pages' => 'required|integer|min:1',
            'description_copy' => 'required|string',
            'number_of_appendix' => 'integer|min:1|nullable',
            'number_of_pages_appendix' => 'required|integer|min:1',
            'case_number' => 'string|nullable',
            'page_in_case' => 'integer|min:1|nullable',
            'relation_document' => 'ired|integer|min:1',
            'outside_num' => 'required|string',
            'outside_date' => 'required|date',
            'correspondent' => 'required|string',
            'return_date' => 'date|nullable',
            'type_name' => 'required|string',
        ];

        $rules['type_name'] = $allRules['type_name'];
        foreach ($columns as $column) {
            $rules[$column] = $allRules[$column];
        }

        return $rules;
    }
}
