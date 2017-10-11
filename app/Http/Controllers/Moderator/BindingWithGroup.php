<?php

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Document;
use Illuminate\Http\Request;

class BindingWithGroup extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute(Request $request, $documentId)
    {
        echo "<h1> Document </h1>";
        $document = Document::find($documentId);
        dump($document);
        echo "<h1> Request </h1>";
        dd($request);
    }
}
