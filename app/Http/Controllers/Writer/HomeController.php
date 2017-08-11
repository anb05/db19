<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Http\Controllers\MainController;
use Illuminate\Http\Request;

class HomeController extends MainController
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->template = 'writer.home';

        $this->title = 'Домашня сторінка';
    }

    public function index()
    {
        return $this->render();
    }
}
