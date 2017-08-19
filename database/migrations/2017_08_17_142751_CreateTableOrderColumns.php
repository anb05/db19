<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_columns', function (Blueprint $table) {
            $table->string('name', 255);
            $table->foreign('name')->references('name')->on('types');
            $table->unsignedInteger('num', false)->nullable();
            $table->unsignedInteger('date', false)->nullable();
            $table->unsignedInteger('author', false)->nullable();
            $table->unsignedInteger('header', false)->nullable();
            $table->unsignedInteger('key_words', false)->nullable();
            $table->unsignedInteger('description', false)->nullable();
            $table->unsignedInteger('number_of_copies', false)->nullable();
            $table->unsignedInteger('number_of_pages', false)->nullable();
            $table->unsignedInteger('description_copy', false)->nullable();
            $table->unsignedInteger('number_of_appendix', false)->nullable();
            $table->unsignedInteger('number_of_pages_appendix', false)->nullable();
            $table->unsignedInteger('case_number', false)->nullable();
            $table->unsignedInteger('page_in_case', false)->nullable();
            $table->unsignedInteger('relation_document', false)->nullable();
            $table->unsignedInteger('outside_num', false)->nullable();
            $table->unsignedInteger('outside_date', false)->nullable();
            $table->unsignedInteger('correspondent', false)->nullable();
            $table->unsignedInteger('return_date', false)->nullable();
//            $table->increments('id');
//            $table->timestamps();
        });

        /**
         * Create a unique key for document registration.
         */
        Schema::table('order_columns', function (Blueprint $table) {
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_columns');
    }
}
