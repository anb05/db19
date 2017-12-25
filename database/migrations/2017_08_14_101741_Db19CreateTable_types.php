<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Db19CreateTableTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * This table used to create forms and views the aplication.
         */
        Schema::create('types', function (Blueprint $table) {
            $table->string('name', 255)->primary();
            $table->string('alias');
            $table->string('native_name');
            $table->string('num', 255)->nullable();
            $table->string('date', 255)->nullable();
            $table->string('author', 255)->nullable();
            $table->string('header', 255)->nullable();
            $table->string('key_words', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('number_of_copies', 255)->nullable();
            $table->string('number_of_pages', 255)->nullable();
            $table->string('description_copy', 255)->nullable();
            $table->string('number_of_appendix', 255)->nullable();
            $table->string('number_of_pages_appendix', 255)->nullable();
            $table->string('case_number', 255)->nullable();
            $table->string('page_in_case', 255)->nullable();
            $table->string('relation_document', 255)->nullable();
            $table->string('outside_num', 255)->nullable();
            $table->string('outside_date', 255)->nullable();
            $table->string('correspondent', 255)->nullable();
            $table->string('return_date', 255)->nullable();
//            $table->string('ua_name');
//            $table->text('description');
//            $table->increments('id');
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
