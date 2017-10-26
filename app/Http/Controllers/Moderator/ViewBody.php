<?php

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\DocBody;
use Illuminate\Http\Request;
use Db19\Repositories\InfoDocRepository;

class ViewBody extends MainController
{
    private $info_rep;

    public function __construct(InfoDocRepository $info_rep)
    {
        parent::__construct();

        $this->info_rep = $info_rep;
    }

    public function execute(Request $request)
    {
        $usersGroup = \Auth::user()->group_name;
        $usersRole  = \Auth::user()->role_name;
        $body = DocBody::find($request->body_id);
        $document = $body->document;
        $groups = $document->groups()->get();
        if ($groups->contains($usersGroup) || $usersRole === 'moderator') {
            return $this->info_rep->viewBinary($body);
        }
//        return redirect()->route('moderator')->with('error', trans('ua.PermissionDenied'));
        abort(404);
    }
}
