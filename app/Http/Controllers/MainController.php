<?php

namespace Db19\Http\Controllers;

use Db19\ModelsApp\Privilege;
use Illuminate\Http\Request;
use Db19\Repositories\MenuRepository;

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
    public function __construct(/*MenuRepository $menu_rep*/)
    {
//        $this->menu_rep = $menu_rep;
        $this->menu_rep = new MenuRepository(new Privilege());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $this->data['mainMenu'] = $this->getMenu();

        return view($this->template, $this->data);
    }

    protected function getMenu()
    {
        $menu = $this->menu_rep->get();

        return $menu;
    }
}
