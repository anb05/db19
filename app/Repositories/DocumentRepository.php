<?php
/**
 */

namespace Db19\Repositories;


use Db19\ModelsDb\Document;
use Illuminate\Database\Eloquent\Model;

class DocumentRepository extends Repository
{
    public function __construct(
        Document $document,
        AsideRepository $aside_rep
    ) {
        parent::__construct($document);
    }
}
