<?php
declare(strick_types=1);

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;
use Db19\Repositories\CreateDocRepository;
use Illuminate\Http\Request;

class CheckedDocument extends MainController
{
    private $doc_rep;

    public function __construct(CreateDocRepository $createDoc_rep)
    {
        parent::__construct();

        $this->template = 'moderator.show_checked';

        $this->title = 'Перегляд перевірених документів';

        $this->keyWords = 'Checked Documents, DataBase, View';

        $this->metaDesc = 'There is viewing checked documents';

        $this->doc_rep = $createDoc_rep;
    }

    public function viewChecked(Request $request, $document_type = false)
    {
        $type = $this->doc_rep->verifyType($document_type);
        $routeName = 'moderator_show_checked';
        $this->template = 'moderator.show_checked';

        if (view()->exists($this->template)) {
            $this->bar = $this->doc_rep->createMenuPanel($routeName);
            $this->contentLeftBar = $this->doc_rep->createAside($type, $routeName);
            $this->data['view_checked'] = $this->doc_rep->viewPrepareds($request, $type);

            $this->contentRightBar = false;
            return $this->render();
        }
        abort(404);
    }
}
