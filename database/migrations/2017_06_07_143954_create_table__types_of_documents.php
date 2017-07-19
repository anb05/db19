<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTypesOfDocuments extends Migration
{
    /**
     * Run the migrations.
     * This migration creates a table for storing information about types of documents
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('types_of_documents', function (Blueprint $table) {
            /**
             * Primary key
             */
            $table->increments('id');

            /**
             * This column keeps types of documents
             */
            $table->string('type', 255);

            /**
             * Date of registration and modification of documents.
             * This method creates two columns in database.
             * First column call create_at.
             * Second column call update_at.
             */
            $table->timestamps();
        });

        /**
         * In these two lines change type of data in columns updated_at and created_at.
         */
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE types_of_documents MODIFY COLUMN updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ');
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE types_of_documents MODIFY COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('types_of_documents');
    }
}
