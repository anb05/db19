<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeingKeyDocumentIdResolutions extends Migration
{
    /**
     * Run the migrations.
     * Create foreign key. Define a 'document_id' column on the 'resolutions'
     * table that references the 'id' column on a 'documents' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->table('resolutions', function (Blueprint $table) {
            $table->foreign('document_id')->references('id')->on('documents');
            $table->foreign('human_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->table('resolutions', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
            $table->dropForeign(['human_id']);
        });
    }
}
