<?php

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Appendix;
use Illuminate\Http\Request;
use Db19\Repositories\InfoDocRepository;

class ViewAppendix extends MainController
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
        $appendix = Appendix::find($request->appendix_id);
        $document = $appendix->document;
        $groups = $document->groups()->get();
        if ($groups->contains($usersGroup) || $usersRole === 'moderator') {
//            dd( $this->info_rep->viewBinary($appendix));
            return $this->info_rep->viewBinary($appendix);
        }
//        return redirect()->route('moderator')->with('error', trans('ua.PermissionDenied'));
        abort(404);
    }
}
