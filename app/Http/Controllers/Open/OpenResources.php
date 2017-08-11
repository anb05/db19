<?php

namespace Db19\Http\Controllers\Open;

use Illuminate\Http\Request;
use Db19\Http\Controllers\MainController;

/**
 * Class OpenResources
 *
 * @package Db19\Http\Controllers\Open
 */
class OpenResources extends MainController
{
    public function __construct()
    {
        parent::__construct();

        return $this->template = 'open.open';
    }

    public function execute()
    {
        $this->title = trans('ua.openInformation');
        return $this->render();
    }
}
