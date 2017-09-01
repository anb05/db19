<?php
/**
 */

namespace Db19\Repositories;

use Db19\ModelsDb\Document;
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
    private $orderColumn;

    private $asideTemplate = 'writer.aside_menu';

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
     * This method creates a records with blob appendix for document
     *
     * @param Request $request
     * @param         $docId
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
            }
        }
    }

    /**
     * This method puts the document body in the database.
     *
     * @param Request $request
     * @param         $docId
     */
    public function insertBody(Request $request, $docId)
    {
        if ($request->file('doc_body')->isValid()) {
            $docBody = $request->file('doc_body');
            $prepareBody = new DocBody();
            $prepareBody->document_id = $docId;
            $prepareBody->appendix = file_get_contents($docBody->getRealPath());
            $prepareBody->original_name = $docBody->getClientOriginalName();
            $prepareBody->mime_type = $docBody->getClientMimeType();
            $prepareBody->size = $docBody->getSize();

            $prepareBody->save();
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

        return $data;
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
                ->route('create_doc', ['document_type' => $request->type_name])
                ->withErrors($validator)
                ->withInput();
        }
        return false;
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
     * @return string
     */
    public function createAside($type)
    {
        if (view()->exists($this->asideTemplate)) {
            $types = $this->getAllTypeName();

            return view('writer.aside_menu', ['types' => $types, 'defaultType' => $type])->render();
        }

        return abort(404);
    }

    /**
     * This method creates a menu of the right sidebar
     *
     * @return string
     */
    public function createMenuPanel()
    {
        if (view()->exists('writer.menu_panel')) {
            return view('writer.menu_panel')->render();
        }

        return abort(404);
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

        return abort(404);
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
     * @param $type
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
