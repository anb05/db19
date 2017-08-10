<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablDocumentGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('document_group', function (Blueprint $table) {
            $table->string('group_name');
            $table->unsignedInteger('document_id');

            $table->foreign('group_name')
                ->references('name')->on('groups');

            $table->foreign('document_id')
                ->references('id')->on('documents');
//            $table->increments('id');
//            $table->timestamps();
        });

        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE document_group ADD PRIMARY KEY (group_name, document_id)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('document_group');
    }
}
