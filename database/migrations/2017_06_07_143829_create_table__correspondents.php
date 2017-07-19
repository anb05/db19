<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCorrespondents extends Migration
{
    /**
     * Run the migrations.
     * This migration creates a table for storing information about
     * the organization from where we received the document.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('correspondents', function (Blueprint $table) {
            /**
             * Primary key
             */
            $table->increments('id');

            /**
             * In here are stored organization's names from where we receive the documents
             */
            $table->string('shot_name', 255);

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
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE correspondents MODIFY COLUMN updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ');
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE correspondents MODIFY COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('correspondents');
    }
}
