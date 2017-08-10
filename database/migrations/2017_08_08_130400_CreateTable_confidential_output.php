<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConfidentialOutput extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('confidential_output', function (Blueprint $table) {
            /**
             * Primary key
             */
            $table->increments('id');

            /**
             * External key. Contains the primary key of the "documents" table.
             */
            $table->integer('document_id', false, true);

            /**
             * This is the first part of the unique key
             * The second part is the column created_at
             * This primary key is not an autoincrement.
             */
            $table->unsignedInteger('num', false);

            /**
             * Date of registration and modification of documents.
             * This method creates two columns in database.
             * First column call create_at.
             * Second column call update_at.
             */
            $table->timestamps();
        });

        DB::connection('mysql_input_doc')->unprepared('ALTER TABLE confidential_output ADD UNIQUE (num, created_at)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('confidential_output');
    }
}
