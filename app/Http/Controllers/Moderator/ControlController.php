<?php

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Control;
use Illuminate\Http\Request;

class ControlController extends MainController
{
    /**
     * ControlController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function execute(Request $request, $control = false)
    {
        if ($request->isMethod('post')) {
            $result = $this->postAction($request);
        } elseif ($request->isMethod('delete') && ((int)$control)) {
            $control = Control::find($control);
            $result = $this->deleteAction($control);
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * @param $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function postAction(Request $request)
    {
        try {
            $this->validate($request, [
                'control_number' => 'required|string|max:100',
                'check_time' => 'required|date',
                'executed_time' => 'date|nullable',
                'document_id' => 'required',
                'responsible_executor'=> 'required|exists:users,id'
            ]);

            $control = new Control($request->except("_token"));
            $control->save();
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'The Control do not insert');
        }
        return redirect()->back()->with('message', 'The Control added');
    }

    private function deleteAction(Control $control)
    {
        try {
            $control->delete();
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'The Control do not deleted!');
        }
        return redirect()->back()->with('message', 'The Control deleted!');
    }
}
