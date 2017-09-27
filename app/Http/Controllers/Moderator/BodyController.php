<?php

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\DocBody;
use Db19\Repositories\CreateDocRepository;
use Illuminate\Http\Request;

class BodyController extends MainController
{
    private $doc_rep;

    /**
     * BodyController constructor.
     *
     * @param CreateDocRepository $doc_rep
     */
    public function __construct(CreateDocRepository $doc_rep)
    {
        parent::__construct();

        $this->doc_rep = $doc_rep;
    }

    /**
     * @param Request $request
     * @param bool    $body
     *
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function execute(Request $request, $body = false)
    {
        $docBody = DocBody::find($body);
        $result = '';

        switch ($request->method()) {
            case 'POST':
                $result = $this->postAction($request);
                break;

            case 'DELETE':
                $result = $this->deleteAction($docBody);
                break;

            default:
                abort(404);
        }

        return $result;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postAction(Request $request)
    {
        try {
            $this->doc_rep->insertBody($request, $request->draftId);
        } catch (\Exception $exception) {
            abort(404);
        }

        return redirect()->back()->with('message', 'The document body added');
    }

    /**
     * @param DocBody $docBody
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function deleteAction(DocBody $docBody)
    {
        try {
            $docBody->delete();
            return redirect()->back()->with('message', 'The Body deleted!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'The Body do not deleted!');
        }
    }
}
