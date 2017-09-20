<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Http\Controllers\MainController;
use Illuminate\Http\Request;

class ControlController extends MainController
{
    public function execute(Request $request)
    {
        dd($request);
    }
}
