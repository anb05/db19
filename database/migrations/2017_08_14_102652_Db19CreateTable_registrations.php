<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Db19CreateTableRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('registrations', function (Blueprint $table) {
            /**
             * Primary key
             */
            $table->increments('id');

            /**
             * External key. Contains the primary key of the "documents" table.
             */
            $table->integer('document_id', false, true);
            $table->foreign('document_id')->references('id')->on('documents');

            /**
             * This column contains the first part of the unique key.
             * Also in this column is the registration number of the document
             */
            $table->string('num', 255);

            /**
             * This column contains the second part of the unique key.
             * Also in this column is the date of registration of the document
             */
            $table->date('date')->nullable();

            /**
             * This column contains the third part of the unique key.
             * Also in this column is the type of the document.
             */
            $table->string('type_name', 50);
//            $table->foreign('type_name')->references('name')->on('types');

//            $table->timestamps();
        });

        /**
         * Create a unique key for document registration.
         */
        Schema::connection('mysql_input_doc')->table('registrations', function (Blueprint $table) {
            $table->unique(['num', 'date', 'type_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('registrations');
    }
}
