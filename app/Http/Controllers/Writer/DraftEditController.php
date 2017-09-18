<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Document;
use Db19\ModelsDb\Registration;
use Illuminate\Http\Request;
use Db19\Repositories\CreateDocRepository;
use PhpParser\Comment\Doc;

/**
 * Class DraftEditController
 *
 * @package Db19\Http\Controllers\Writer
 */
class DraftEditController extends MainController
{
    private $doc_rep;

    /**
     * DraftEditController constructor.
     *
     * @param CreateDocRepository $doc_rep
     */
    public function __construct(CreateDocRepository $doc_rep)
    {
        parent::__construct();

        $this->doc_rep = $doc_rep;

        $this->template = 'writer.draft_edit';

        $this->title = 'Edit document';

        $this->keyWords = 'Documents, Drafts, Edit, Checked';

        $this->metaDesc = 'For changed documents';
    }

    /**
     * @param Request  $request
     * @param Document $draft
     *
     * @return $this|bool|\Illuminate\Http\RedirectResponse
     */
    public function postAction(Request $request, Document $draft)
    {
        $validate = $this->doc_rep->validateInput($request);

        if ($validate) {
            return $validate;
        }

        if ($request->id != $draft->id) {
            abort(404);
        }

        $docData = $this->doc_rep->prepareDataDoc($request);
        foreach ($docData as $key => $value) {
            $draft->$key = $value;
        }

        try {
            $draft->save();
            try {
//                $regData = Registration::;
            } catch (\Exception $exception) {
                abort(404);
            }
        } catch (\Exception $exception) {
            abort(404);
        }



        echo "<h4>docData</h4>";
        dump($docData);

//        echo "<h4>regData</h4>";
//        dump($regData);




        echo "<h1> DRAFT</h1>";

        dd($draft);
        return redirect()->back()->with('message', trans('ua.ReloadedDraft'));
    }

    /**
     * @param Document $draft
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function viewEditFormAction(Document $draft)
    {
        if (view()->exists($this->template)) {
            $this->data['nativeTypeName'] = $this->doc_rep->getNativeTypeName($draft);
            $this->data['docTitle'] = $draft->header;
            if (view()->exists('writer.title_edit')) {
                $pageTitle = view('writer.title_edit', $this->data);
            } else {
                $pageTitle = '';
            }
            $this->data['nativeTypeName'] = $pageTitle;

            $this->data['docFields'] = $this->doc_rep->editFieldsDraft($draft);

            return $this->render();
        }
        abort(404);
    }

    /**
     * This is a router Actions.
     *
     * @param Request $request
     * @param string  $draftId
     *
     * @return mixed
     */
    public function execute(Request $request, $draftId)
    {
        $draft = Document::find($draftId);

        switch ($request->method()) {
            case 'POST':
                $result = $this->postAction($request, $draft);
                break;

            case 'DELETE':
                $result = $this->deleteAction($draft);
                break;

            case 'PREPARED':
                $result = $this->prepareAction($draft);
                break;

            default:
                $result = $this->viewEditFormAction($draft);
        }

        return $result;
    }

    /**
     * This method changes the document state from "draft" to "prepared".
     *
     * @param Document $draft
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function prepareAction(Document $draft)
    {
        $draft->state_name = 'prepared';
        $draft->save();

        return redirect()->back()->with(['message' => trans('ua.createPrepare')]);
    }

    /**
     * This method deletes all record of the document.
     *
     * @param Document $draft
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function deleteAction(Document $draft)
    {
        $docId = $draft->id;
        try {
            $this->doc_rep->deleteResolutions($docId);
            $this->doc_rep->deleteControls($docId);
            $this->doc_rep->deleteDocBody($docId);
            $this->doc_rep->deleteAppendices($docId);
            $this->doc_rep->deleteReg($docId);
            $this->doc_rep->deleteDoc($docId);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['message' => trans('ua.Do not deletion')]);
        }

        return redirect()->back()->with(['message' => trans('ua.The Documents deleted')]);
    }
}
