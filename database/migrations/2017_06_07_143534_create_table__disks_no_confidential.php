<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDisksNoConfidential extends Migration
{
    /**
     * Run the migrations.
     * This migration creates table to keep in store information about disks number.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('no_confidential_disks', function (Blueprint $table) {
            /**
             * This is the first part of the primary key
             * The second part is the column created_at
             * This primary key is not an autoincrement.
             */
            $table->unsignedInteger('id');

            /**
             * Date of registration and modification of documents.
             * This method creates two columns in database.
             * First column call create_at.
             * Second column call update_at.
             */
            $table->timestamps();

            /**
             * This column contain full number of disk
             */
            $table->string('full_number_disk', 255);

            /**
             * External key. Contains the primary key of the "documents" table.
             */
            $table->integer('document_id', false, true);
        });

        /**
         * In these two lines change type of data in columns updated_at and created_at.
         */
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE no_confidential_disks MODIFY COLUMN updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ');
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE no_confidential_disks MODIFY COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ');

        Schema::connection("mysql_input_doc")->table('no_confidential_disks', function (Blueprint $table) {
            $table->unique(['id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('no_confidential_disks');
    }
}
