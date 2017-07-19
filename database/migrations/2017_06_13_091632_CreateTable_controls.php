<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableControls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->create('controls', function (Blueprint $table) {
            /**
             * Primary key
             */
            $table->increments('id');

            /**
             * This column contains registration control numbers
             */
            $table->string('control_number', 100);

            /**
             * Date of registration and modification of documents.
             * This method creates two columns in database.
             * First column call create_at.
             * Second column call update_at.
             */
            $table->timestamps();

            /**
             * This column contains the time when the work should be completed
             */
//            $table->timestamp('check_time');

            /**
             * External key. Contains the primary key of the "documents" table.
             */
            $table->integer('document_id', false, true)->unique();
            $table->foreign('document_id')->references('id')->on('documents');

            /**
             * This column contains the id of responsible executor
             */
            $table->unsignedInteger('responsible_executor');
            $table->foreign('responsible_executor')->references('id')->on('users');
        });

        /**
         * In these two lines change type of data in columns updated_at and created_at.
         */
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE controls MODIFY COLUMN updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ');
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE controls MODIFY COLUMN created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ');

        /**
         * It is create column "outside_date".
         */
        DB::connection("mysql_input_doc")->unprepared('ALTER TABLE controls ADD COLUMN check_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER control_number');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->dropIfExists('controls');
    }
}
