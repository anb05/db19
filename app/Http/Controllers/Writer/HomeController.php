<?php

namespace Db19\Http\Controllers\Writer;

use Db19\Repositories\CreateDocRepository;
use Db19\Http\Controllers\MainController;
use Illuminate\Http\Request;

class HomeController extends MainController
{
    private $doc_rep;

    /**
     * HomeController constructor.
     *
     * @param CreateDocRepository $doc_rep
     */
    public function __construct(CreateDocRepository $doc_rep)
    {
        parent::__construct();

        $this->doc_rep = $doc_rep;

        $this->template = 'writer.home';

        $this->title = 'Домашня сторінка';
    }

    public function index()
    {
        return $this->render();
    }

//    public function showDrafts(Request $request, $sortBy = false)
//    {
//        $this->data['draftDoc'] = $this->doc_rep->getDrafts($request, $sortBy);
//        return $this->render();
//    }
}
