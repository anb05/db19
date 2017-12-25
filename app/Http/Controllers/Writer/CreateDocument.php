<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Http\Controllers\MainController;
use Db19\Repositories\CreateDocRepository;
use Illuminate\Http\Request;

/**
 * Class CreateDocument
 *
 * @package Db19\Http\Controllers\Writer
 */
class CreateDocument extends MainController
{
    private $doc_rep;

    /**
     * CreateDocument constructor.
     *
     * @param CreateDocRepository $createDoc_rep
     *
     * @internal param CreateDocRepository $createForm_rep
     */
    public function __construct(CreateDocRepository $createDoc_rep)
    {
        parent::__construct();

        $this->template = 'writer.create';

        $this->title = 'Новий документ';

        $this->keyWords = 'New Document, DataBase, Create';

        $this->metaDesc = 'For create a new document';

        $this->doc_rep = $createDoc_rep;
    }

    /**
     * @param bool $document_type
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($document_type = false)
    {
        $type = $this->doc_rep->verifyType($document_type);
        $routeName = 'writer_create_doc';

        if (view()->exists($this->template)) {
            $this->data['aside'] = $this->doc_rep->createAside($type, $routeName);

            $this->data['menu_panel'] = $this->doc_rep->createMenuPanel($routeName);

            $this->data['form_create_doc'] = $this->doc_rep->createForm($type);

            return $this->render();
        }

        return abort(404);
    }

    public function showDrafts(Request $request, $document_type = false)
    {
        $type = $this->doc_rep->verifyType($document_type);
        $routeName = 'writer_show_drafts';
        $this->template = 'writer.show_drafts';

        if (view()->exists($this->template)) {
            $this->data['aside'] = $this->doc_rep->createAside($type, $routeName);

            $this->data['menu_panel'] = $this->doc_rep->createMenuPanel($routeName);

            $this->data['view_drafts'] = $this->doc_rep->viewDrafts($request, $type);

            return $this->render();
        }
        abort(404);
    }

    /**
     * This method creates new record in database
     *
     * @param Request $request
     *
     * @return $this|bool
     */
    public function create(Request $request)
    {
        $validate = $this->doc_rep->validateInput($request);

        if ($validate) {
            return $validate;
        }

        $data = $this->doc_rep->prepareDataDoc($request);
        try {
            $docId = $this->doc_rep->insertDoc($data);
            \Session::put('document_id', $docId);

            $reg = $this->doc_rep->prepareRegData($request, $docId);
            $this->doc_rep->insertReg($reg);
            if ($request->hasFile('doc_body')) {
                try {
                    $this->doc_rep->insertBody($request, $docId);
                    if ($request->hasFile('appendices')) {
                        try {
                            $this->doc_rep->insertAppendices($request, $docId);
                        } catch (\Exception $exception) {
                            $this->doc_rep->deleteDocBody($docId);
                            $this->doc_rep->deleteReg($docId);
                            $this->doc_rep->deleteDoc($docId);

                            return redirect()
                                ->route('writer_create_doc', ['document_type' => $request->type_name])
                                ->with('error', trans('ua.errorUploadsAppendices'))
                                ->withInput();
                        }
                    }
                } catch (\Exception $exception) {
                    $this->doc_rep->deleteReg($docId);
                    $this->doc_rep->deleteDoc($docId);

                    return redirect()
                        ->route('writer_create_doc', ['document_type' => $request->type_name])
                        ->with('error', trans('ua.errorUploadsDocument'))
                        ->withInput();
                }
            }
        } catch (\Exception $exception) {
            return redirect()
                ->route('writer_create_doc', ['document_type' => $request->type_name])
                ->with('error', trans('ua.errorCreateDocument'))
                ->withInput();
        }

        $request->session()->put('draftsSort', 'documents.updated_at');
        $request->session()->put('directionDrafts', 'desc');

        return redirect()
            ->route('writer_show_drafts', ['document_type' => $request->type_name])
            ->with(['message' => trans('ua.createTrash')])
            ->withInput();
    }
}
