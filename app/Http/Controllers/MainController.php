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

    /**
     * This variable stores the Title of the Page
     *
     * @var string
     */
    protected $title = '';

    /**
     * This variable contains a key words for Meta header
     *
     * @var string
     */
    protected $keyWords = '';

    /**
     * This variable contains a Page Description for Meta header
     *
     * @var string
     */
    protected $metaDesc = '';

    /**
     * Top additional navigation bar on the page
     *
     * @var bool | string
     */
    protected $bar = false;

    /**
     * The Left Aside bar
     *
     * @var bool | string
     */
    protected $contentLeftBar = false;

    /**
     * The Right Aside bar
     *
     * @var bool | string
     */
    protected $contentRightBar = false;

    /**
     * Association array of data for view
     *
     * @var array
     */
    protected $data = [];

    /**
     * @var \Db19\Repositories\MenuRepository
     */
    protected $menu_rep;

    /**
     * MainController constructor.
     */
    public function __construct()
    {
        $this->menu_rep = new MenuRepository(new Privilege());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render()
    {
        $this->data['mainMenu']   = $this->getMenu();
        $this->data['leftAside']  = $this->contentLeftBar;
        $this->data['rightAside'] = $this->contentRightBar;

        \Config::set('app.name', $this->title);

        return view($this->template, $this->data)->render();
    }

    protected function getMenu()
    {
        $menu = $this->menu_rep->get();

        return $menu;
    }
}
