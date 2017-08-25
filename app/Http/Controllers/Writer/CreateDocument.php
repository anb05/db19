<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\State;
use Db19\Repositories\AsideRepository;
use Db19\Repositories\CreateFormRepository;
use Illuminate\Http\Request;

/**
 * Class CreateDocument
 *
 * @package Db19\Http\Controllers\Writer
 */
class CreateDocument extends MainController
{
    private $aside_rep;

    private $form_rep;

    private $asideTemplate = 'writer.aside_menu';

    /**
     * HomeController constructor.
     *
     * @param CreateFormRepository $createForm_rep
     */
    public function __construct(CreateFormRepository $createForm_rep)
    {
        parent::__construct();

        $this->template = 'writer.create';

        $this->title = 'Новий документ';

        $this->keyWords = 'New Document, DataBase, Create';

        $this->metaDesc = 'For create a new document';

        $this->form_rep = $createForm_rep;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (view()->exists($this->template)) {
            $this->data['aside'] = $this->form_rep->createAside();

            $this->data['menu_panel'] = $this->form_rep->createMenuPanel();

            $this->data['form_create_doc'] = $this->form_rep->createForm();

            return $this->render();
        }

        abort(404);
    }

    public function create(Request $request)
    {
        echo "<h1>" . __METHOD__ . "</h1>";
        if ($request->isMethod('post')) {
            echo "<h1>" . __METHOD__ . "</h1>";
            dd('POST');
        }
    }
}
