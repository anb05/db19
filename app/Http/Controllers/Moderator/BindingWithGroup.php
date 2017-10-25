<?php

namespace Db19\Http\Controllers\Moderator;

use Db19\Http\Controllers\MainController;
use Db19\ModelsDb\Document;
use Db19\ModelsDb\Group;
use Illuminate\Http\Request;

class BindingWithGroup extends MainController
{
    private $connection = 'mysql_input_doc';

    private $table = 'document_group';

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(Request $request)
    {
        $document = Document::find($request->documentId);
        if (empty($document)) {
            return redirect()->back()->with('error', trans('ua.Document not found'));
        }

        // Удалить все записи в таблице "document_group" с полем "document_id" = $request->documentId
        $groups = $document->groups()->get();
        if ($groups->isNotEmpty()) {
            foreach ($groups as $group) {
                $group->pivot->delete();
            }
        }

        if ($request->has('select_group')) {
            foreach ($request->select_group as $groupName) {
                $single['group_name'] = $groupName;
                $single['document_id'] = $request->documentId;
                $data[] = $single;
            }
            try {
                $result = \DB::connection($this->connection)->table($this->table)->insert($data);
            } catch (\Exception $exception) {
                return redirect()->back()->with('error', trans('ua.ErrorAccess'));
            }
        }

        return redirect()->back()->with('message', trans('ua.AccessChanged'));
    }
}
