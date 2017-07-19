<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeingKeyDocumentIdNoConfidentialInventorys extends Migration
{
    /**
     * Run the migrations.
     * Create foreign key. Define a 'document_id' column on the 'no_confidential_inventorys'
     * table that references the 'id' column on a 'documents' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->table('no_confidential_inventorys', function (Blueprint $table) {
            $table->foreign('document_id')->references('id')->on('documents');
//            $table->unique('document_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->table('no_confidential_inventorys', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
//            $table->dropUnique('no_confidential_inventorys_document_id_unique');
        });
    }
}
