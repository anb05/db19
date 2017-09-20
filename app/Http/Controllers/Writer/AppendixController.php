<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Appendix;
use Db19\Repositories\CreateDocRepository;
use Illuminate\Http\Request;

class AppendixController extends MainController
{
    private $doc_rep;

    /**
     * AppendixController constructor.
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
     * @param bool    $appendix
     *
     * @return string
     */
    public function execute(Request $request, $appendix = false)
    {
        $appendix = Appendix::find($appendix);
        $result = '';

        switch ($request->method()) {
            case 'POST':
                $result = $this->postAction($request);
                break;

            case 'DELETE':
                $result = $this->deleteAction($appendix);
                break;

            default:
                abort(404);
        }

        return $result;
    }

    private function postAction(Request $request)
    {
        try {
            $this->doc_rep->insertAppendices($request, $request->draftId);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'The appendices do not insert');
        }

        return redirect()->back()->with('message', 'The document appendices added');
    }

    /**
     * @param Appendix $appendix
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function deleteAction(Appendix $appendix)
    {
        try {
            $appendix->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'The Appendix do not deleted!');
        }
        return redirect()->back()->with('message', 'The Appendix deleted!');
    }
}
