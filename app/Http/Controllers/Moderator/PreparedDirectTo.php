<?php

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Document;
use Illuminate\Http\Request;

/**
 * Class PreparedDirectTo
 *
 * @package Db19\Http\Controllers\Moderator
 */
class PreparedDirectTo extends MainController
{
    /**
     * MainController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param Request $request
     * @param         $preparedId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function execute(Request $request, $preparedId)
    {
        $prepared = Document::find($preparedId);

        if ($request->direct_to === 'to_draft') {
            $prepared->state_name = 'draft';
            try {
                $prepared->save();
                return redirect()
                    ->route('moderator_show_prepareds')
                    ->with('message', trans('ua.The document has been moved to drafts'));
            } catch (\Exception $exception) {
                return redirect()->back()->with('error', trans('ua.Error! The document has not been moved to drafts'));
            }
        } elseif ($request->direct_to === 'to_checked') {
            try {
                $groups = $prepared->groups;
                if ($groups->isEmpty()) {
                    return redirect()
                        ->back()
                        ->with('error', trans('ua.You must select at least one group'));
                }
                $prepared->state_name = 'checked';
                $prepared->hard_deletion = false;
                $prepared->save();
                return redirect()
                    ->route('moderator_show_prepareds')
                    ->with('message', trans('ua.The document is transferred to work'));
            } catch (\Exception $exception) {
                return redirect()->back()->with('error', trans('ua.Error! The document is not transferred to work'));
            }
        } else {
            abort(404);
        }
    }
}
