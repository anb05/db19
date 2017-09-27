<?php

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;

/**
 * Class HomeController
 *
 * @package Db19\Http\Controllers\Moderator
 */
class HomeController extends MainController
{
    /**
     * MainController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->template = 'moderator.home';

        $this->title = 'Домашня сторінка модератора';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return $this->render();
    }
}
