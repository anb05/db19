<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSerialNumbersConfidential extends Migration
{
    /**
     * Run the migrations.
     * This migration creates table to keep in store information about incoming number.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('confidential_numbers', function (Blueprint $table) {
            /**
             * This is the first part of the primary key
             * The second part is the column created_at
             * This primary key is not an autoincrement.
             */
            $table->unsignedInteger('id', false);

            /**
             * Date of registration and modification of documents.
             * This method creates two columns in database.
             * First column call create_at.
             * Second column call update_at.
             */
            $table->timestamps();

            /**
             * External key. Contains the primary key of the "documents" table.
             */
            $table->integer('document_id', false, true);
        });

        /**
         * In these two lines change type of data in columns updated_at and created_at.
         */
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE confidential_numbers MODIFY COLUMN updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ');
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE confidential_numbers MODIFY COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ');

//        Schema::connection("mysql_input_documents")->table('confidential_numbers', function (Blueprint $table) {
//            $table->index(['id', 'created_at']);
//        });

        DB::connection('mysql_input_doc')->unprepared('ALTER TABLE confidential_numbers ADD UNIQUE (id, created_at)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('confidential_numbers');
    }
}
