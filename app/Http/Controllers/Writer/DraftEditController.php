<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Document;
use Illuminate\Http\Request;
use Db19\Repositories\CreateDocRepository;

/**
 * Class DraftEditController
 *
 * @package Db19\Http\Controllers\Writer
 */
class DraftEditController extends MainController
{
    private $doc_rep;

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
                $action = 'postAction';
                break;

            case 'DELETE':
                $action = 'deleteAction';
                break;

            case 'PREPARED':
                $action = 'prepareAction';
                break;

            default:
                $action = 'viewEditFormAction';
        }
        $result = $this->$action($draft);

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

    private function viewEditFormAction(Document $draft)
    {
        if (view()->exists($this->template)) {
            dump($draft);

            echo "<h1>EDIT</h1>";

            echo __METHOD__;

            return $this->render();
        }
        abort(404);
    }
}
