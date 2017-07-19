<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocuments extends Migration
{
    /**
     * Run the migrations.
     * This migration create table to keep in store information about documents.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('documents', function (Blueprint $table) {
            /**
             * Primary key
             */
            $table->increments('id');

            /**
             * Date of creating and modification of documents.
             * This method creates two columns in database.
             * First column call create_at.
             * Second column call update_at.
             */
            $table->timestamps();

            /**
             * This column keeps in store about outside serial numbers of incoming of documents.
             */
            $table->string('outside_serial', 255);

            /**
             * This method is building column for keeping in store of date outside of registration.
             * But it does not work. For created this column used method placed below.
             */
//            $table->timestamp('outside_date');

            /**
             * This method is building column for keeping in store information about author of document.
             */
            $table->string('author', 255);

            /**
             * This method is building column for keeping in store information
             * about annotation ore/and title of document
             */
            $table->text('header');

            /**
             * This is foreign key from correspondents table.
             */
            $table->unsignedInteger('correspondent_id');

            /**
             * This is foreign key from types_of_document
             */
            $table->unsignedInteger('type_id');

            /**
             * This method creates columns for storing keywords in the repository.
             * These words provide a search in the database.
             */
            $table->string('key_words', 255);

            /**
             * This column stores the copy number.
             */
            $table->unsignedInteger('number_of_copies');

            /**
             * This column stores information about number of pages in the document.
             */
            $table->unsignedInteger('number_of_pages');

            /**
             * This column stores the number of appendix.
             */
            $table->unsignedInteger('number_of_appendix')->default(0);

            /**
             * This column stores information about total of pages in all appendixes.
             */
            $table->unsignedInteger('number_of_pages_appendix')->default(0);

            /**
             * This column stores information about case number where the document is stored.
             */
            $table->string('case_number', 255);

            /**
             * This column stores information about page number in the case.
             */
            $table->unsignedInteger('page_in_case');

            /**
             * If this document is response, this column store information about parent document.
             */
            $table->string('output_document')->nullable();
        });

        /**
         * In these two lines change type of data in columns updated_at and created_at.
         */
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE documents MODIFY COLUMN updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ');
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE documents MODIFY COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ');

        /**
         * It is create column "outside_date".
         */
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE documents ADD COLUMN outside_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER outside_serial');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('documents');
    }
}
