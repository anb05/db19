<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Resolution;
use Illuminate\Http\Request;

/**
 * Class ResolutionController
 *
 * @package Db19\Http\Controllers\Writer
 */
class ResolutionController extends MainController
{
    /**
     * ResolutionController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function execute(Request $request, $resolution = false)
    {
        if ($request->isMethod('post')) {
            $result = $this->postAction($request);
        } elseif ($request->isMethod('delete') && ((int)$resolution)) {
                $resolution = Resolution::find($resolution);
                $result = $this->deleteAction($resolution);
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * @param Resolution $resolution
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function deleteAction(Resolution $resolution)
    {
        try {
            $resolution->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'The Resolution do not deleted!');
        }
        return redirect()->back()->with('message', 'The Resolution deleted!');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postAction(Request $request)
    {
        try {
            $this->validate($request, [
                'document_id' => 'required',
                'human_id' => 'required|exists:users,id',
                'resolution' => 'required|string',
                'date' => 'required|before_or_equal:today'
            ]);

            $resolution = new Resolution($request->except("_token"));
            $resolution->save();
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'The Resolution do not insert');
        }
        return redirect()->back()->with('message', 'The Resolution added');
    }
}
