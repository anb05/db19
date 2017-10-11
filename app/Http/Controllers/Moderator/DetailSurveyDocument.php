<?php

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Document;
use Db19\Repositories\CreateDocRepository;
use Db19\Repositories\InfoDocRepository;
use Illuminate\Http\Request;

/**
 * Class DetailSurveyDocument
 *
 * @package Db19\Http\Controllers\Moderator
 */
class DetailSurveyDocument extends MainController
{
    protected $template = 'common.detail_survey_document';

    protected $title = 'Detailed information about the document';

    protected $keyWords = 'Information, Document';

    protected $metaDesc = 'Detailed information about the document';

    private $info_rep;

    private $doc_rep;

    private $document;

    /**
     * MainController constructor.
     *
     * @param InfoDocRepository $info_rep
     */
    public function __construct(InfoDocRepository $info_rep, CreateDocRepository $doc_rep)
    {
        parent::__construct();

        $this->info_rep = $info_rep;
        $this->doc_rep = $doc_rep;
    }

    public function execute(Request $request)
    {
        $this->document = Document::find($request->documentId);

        $this->data['nativeTypeName'] = $this->doc_rep->getNativeTypeName($this->document);
        $this->data['docTitle'] = $this->document->header;
        if (view()->exists('writer.title_edit')) {
            $pageTitle = view('writer.title_edit', $this->data);
        } else {
            $pageTitle = '';
        }
        $this->data['nativeTypeName'] = $pageTitle;
        $this->data['informationAboutControls'] = $this->info_rep->getControls($this->document);
        $this->data['informationAboutResolutions'] = $this->info_rep->getResolutions($this->document);
        $this->data['informationAboutDocument'] = $this->info_rep->getDocInfo($this->document);
        $this->data['viewingElectronicsCopies'] = $this->info_rep->viewCopies($this->document);
        $this->data['bindWithGroups'] = $this->info_rep->bindDocWitGroup($this->document);
        $this->data['moveTo'] = $this->info_rep->preparedMoveTo($this->document);
        return $this->render();
    }
}
