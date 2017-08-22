<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Http\Controllers\MainController;
use Db19\Repositories\AsideRepository;
use Illuminate\Http\Request;

class CreateDocument extends MainController
{
    private $aside_rep;

    private $asideTemplate = 'writer.aside_menu';

    /**
     * HomeController constructor.
     *
     * @param AsideRepository $aside_rep
     */
    public function __construct(AsideRepository $aside_rep)
    {
        parent::__construct();

        $this->template = 'writer.create';

        $this->title = 'Новий документ';

        $this->keyWords = 'New Document, DataBase, Create';

        $this->metaDesc = 'For create a new document';

        $this->aside_rep = $aside_rep;
    }

    public function index()
    {
        if (view()->exists($this->template)) {
            if (view()->exists($this->asideTemplate)) {
                $type = $this->aside_rep->getAllType();
                $this->data['aside'] = view('writer.aside_menu', ['types' => $type])->render();
            } else {
                abort(404);
            }

            return $this->render();
        }

        abort(404);
    }
}
