<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResolutions extends Migration
{
    /**
     * Run the migrations.
     * This migration creates a table for storing information with instructions
     * from the senior manager
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('resolutions', function (Blueprint $table) {
            /**
             * Primary key
             */
            $table->increments('id');

            /**
             * External key. Contains the primary key of the "documents" table.
             */
            $table->integer('document_id', false, true);

            /**
             * External key. Contains the primary key of the "users" table.
             */
            $table->integer('human_id', false, true);

            /**
             * This column keeps with instruction from the senior manager
             */
            $table->string('resolution');

            /**
             * Date of registration and modification of documents.
             * This method creates two columns in database.
             * First column call create_at.
             * Second column call update_at.
             */
//            $table->timestamps();

            $table->date('date');
        });

        /**
         * In these two lines change type of data in columns updated_at and created_at.
         */
//        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE resolutions MODIFY COLUMN updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ');
//        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE resolutions MODIFY COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('resolutions');
    }
}
