<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Http\Controllers\MainController;
use Illuminate\Http\Request;

class CreateDocument extends MainController
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->template = 'writer.create';

        $this->title = 'Новий документ';
    }

    public function index()
    {
        return $this->render();
    }
}
