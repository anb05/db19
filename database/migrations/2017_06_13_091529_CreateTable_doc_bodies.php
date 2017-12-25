<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocBodies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('doc_bodies', function (Blueprint $table) {
            /**
             * Primary key
             */
            $table->increments('id');

            /**
             * External key. Contains the primary key of the "documents" table.
             */
            $table->integer('document_id', false, true)->unique();
            $table->foreign('document_id')->references('id')->on('documents');

            /**
             * This column contains the bodies of all documents
             */
            $table->binary('appendix');

            /**
             * This column contains the original name of the uploaded file.
             */
            $table->string('original_name', 255)->nullable();

            /**
             * This column contains the mime type of the uploaded file.
             */
            $table->string('mime_type', 255)->nullable();

            /**
             * This column contains the size of the uploaded file.
             */
            $table->unsignedInteger('size')->default(0);

//            $table->timestamps();
        });

        /**
         * In these lines change data type in the columns appendix tables of the doc_bodies and appendices.
         */
        DB::connection("mysql_input_doc")
            ->unprepared('ALTER TABLE doc_bodies MODIFY COLUMN appendix LONGBLOB ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('doc_bodies');
    }
}
