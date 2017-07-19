<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeingKeyCorrespondentId extends Migration
{
    /**
     * Run the migrations.
     * Create foreign key. Define a 'correspondent_id' column on the 'documents'
     * table that references the 'id' column on a 'correspondents' table.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->table('documents', function (Blueprint $table) {
            $table->foreign('correspondent_id')->references('id')->on('correspondents');
            $table->foreign('type_id')->references('id')->on('types_of_documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->table('documents', function (Blueprint $table) {
            $table->dropForeign(['correspondent_id']);
            $table->dropForeign(['type_id']);
        });
    }
}
