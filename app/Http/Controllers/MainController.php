<?php

namespace Db19\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class MainController
 *
 * @package Db19\Http\Controllers
 */
class MainController extends Controller
{
    /**
     * This variable stores the full name of the blade template for the response to the USER
     *
     * @var string
     */
    protected $template = '';

    protected $title = '';

    protected $keyWords = '';

    protected $metaDesc = '';

    protected $bar = false;

    protected $contentLeftBar = false;

    protected $contentRightBar = false;

    protected $data = [];

    protected $menu_rep;

    protected $group_rep;

    protected $role_rep;

    /**
     * MainController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        return view($this->template, $this->data);
    }
}
