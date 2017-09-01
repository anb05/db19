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
             * This column caters soft deleting
             */
            $table->softDeletes();

            /**
             * This column for keeping in store date when the document returned back.
             */
            $table->date('return_date')->nullable();

            /**
             * This method is building column for keeping in store information about author of document.
             */
            $table->string('author', 255)->nullable();

            /**
             * This method is building column for keeping in store information
             * about annotation ore/and title of document
             */
            $table->text('header')->nullable();

            /**
             * This method creates columns for storing keywords in the repository.
             * These words provide a search in the database.
             */
            $table->text('key_words')->nullable();

            /**
             * This column keeps in store description about document
             */
            $table->text('description')->nullable();

            /**
             * This column stores the copy number.
             */
            $table->unsignedInteger('number_of_copies')->nullable();

            /**
             * This column stores information about number of pages in the document.
             */
            $table->unsignedInteger('number_of_pages')->nullable();

            /**
             * This column stores in detail information about everyone copy of the document.
             */
            $table->text('description_copy')->nullable();

            /**
             * This column stores the number of appendix.
             */
            $table->unsignedInteger('number_of_appendix')->nullable();

            /**
             * This column stores information about total of pages in all appendixes.
             */
            $table->unsignedInteger('number_of_pages_appendix')->nullable();

            /**
             * This column stores information about case number where the document is stored.
             */
            $table->string('case_number', 255)->nullable();

            /**
             * This column stores information about page number in the case.
             */
            $table->unsignedInteger('page_in_case')->nullable();

            /**
             * If this document is response, this column store information about parent document.
             */
            $table->unsignedInteger('relation_document', false)->nullable();

            /**
             * This column is a foreign key. It refers to the user who created this record.
             */
            $table->unsignedInteger('creator_id');

            /**
             * This is foreign key from types_of_document
             */
            $table->string('state_name', 50);

            /**
             * This column keeps in store about outside serial numbers of incoming of documents.
             */
            $table->string('outside_num', 255)->nullable();

            /**
             * This method is building column for keeping in store of date outside of registration.
             * But it does not work. For created this column used method placed below.
             */
            $table->date('outside_date')->nullable();

            /**
             * This column keeps in store about correspondents.
             */
            $table->text('correspondent')->nullable();

            /**
             * This column stores the hard delete flag.
             */
            $table->boolean('hard_deletion')->default(true);
        });

        /**
         * In these two lines change type of data in columns updated_at and created_at.
         */
//        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE documents MODIFY COLUMN updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ');
//        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE documents MODIFY COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ');

        /**
         * It is create column "outside_date".
         */
//        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE documents ADD COLUMN outside_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER outside_serial');
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
