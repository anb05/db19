<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInventorysConfidential extends Migration
{
    /**
     * Run the migrations.
     * This migration creates table to keep in store information about inventory number.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('confidential_inventorys', function (Blueprint $table) {
            /**
             * Primary key
             */
            $table->increments('id');

            /**
             * This column contain full inventory number of document
             */
            $table->string('full_inventory', 255);

            /**
             * External key. Contains the primary key of the "documents" table.
             */
            $table->integer('document_id', false, true);

            /**
             * This is the first part of the primary key
             * The second part is the column created_at
             * This primary key is not an autoincrement.
             */
//            $table->unsignedInteger('id');

            /**
             * Date of registration and modification of documents.
             * This method creates two columns in database.
             * First column call create_at.
             * Second column call update_at.
             */
//            $table->timestamps();
        });

        /**
         * In these two lines change type of data in columns updated_at and created_at.
         */
//        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE confidential_inventorys MODIFY COLUMN updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ');
//        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE confidential_inventorys MODIFY COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ');

//        Schema::connection("mysql_input_doc")->table('confidential_inventorys', function (Blueprint $table) {
//            $table->unique(['id', 'created_at']);
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('confidential_inventorys');
    }
}
