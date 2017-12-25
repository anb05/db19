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
                $result = $this->viewEditFormAction($request, $draft);
        }

        return $result;
    }

    /**
     * @param Request  $request
     * @param Document $draft
     *
     * @return $this|bool|\Illuminate\Http\RedirectResponse
     */
    private function postAction(Request $request, Document $draft)
    {
        $validate = $this->doc_rep->validateInput($request);

        if ($validate) {
            return $validate;
        }

        if (($request->id != $request->session()->get('draftId'))
            || ($request->type_name != $request->session()->get('type_name'))) {
            abort(404);
        }

        $docData = $this->doc_rep->prepareDataDoc($request);
        foreach ($docData as $key => $value) {
            $draft->$key = $value;
        }

        try {
            $regData = Registration::whereDocumentId($request->id)->get()->last();
            $regData->num = $request->num;
            $regData->date = $request->date;
            $regData->save();
            try {
                $draft->save();
            } catch (\Exception $exception) {
                abort(404);
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', trans('ua.The draft do not reloaded. Check the input data.'));
//            abort(404);
        }

        return redirect()->back()->with('message', trans('ua.ReloadedDraft'));
    }

    /**
     * @param Request  $request
     * @param Document $draft
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function viewEditFormAction(Request $request, Document $draft)
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
            $this->data['bodiesInfo'] = $this->doc_rep->viewBodyInfo($draft);
            $this->data['controlInfo'] = $this->doc_rep->viewControlAndResolution($draft);

            $this->data['docFields'] = $this->doc_rep->editFieldsDraft($request, $draft);

            return $this->render();
        }
        abort(404);
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
            return redirect()->back()->with(['error' => trans('ua.Do not deletion')]);
        }

        return redirect()->back()->with(['message' => trans('ua.The Documents deleted')]);
    }
}
