<?php

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Document;
use Db19\ModelsDb\Group;
use Illuminate\Http\Request;

class BindingWithGroup extends MainController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function execute(Request $request)
    {
//        $this->validate($request, [
//            'documentId' => 'required|unique:mysql_input_doc.documents:id'
//        ]);
//        echo "<h1>Validate with</h1>";

        echo "<h1> Document </h1>";
        $document = Document::find($request->documentId);
        dump($document);

        $gr = $document->groups()->get();
        echo "<h1>gr belong && get</h1>";
        dump($gr);

        $bindings = \DB::connection('mysql_input_doc')
            ->table('document_group')
            ->where('document_id', '=', $request->documentId)
            ->get();
        echo "<h1>binding</h1>";
        dump($bindings);

//        $bindings = \DB::connection('mysql_input_doc')
//            ->table('document_group')
//            ->where('document_id', '=', $documentId)
//            ->delete();
//
//        echo "<h1>binding DEL</h1>";
//        dump($bindings);

        $groups = Group::all();
        echo "<h1>Groups</h1>";
        dump($groups);

        echo "<h1> Request </h1>";
        dd($request->documentId);
    }
}
