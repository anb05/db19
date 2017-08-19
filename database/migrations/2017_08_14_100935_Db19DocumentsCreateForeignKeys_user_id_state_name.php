<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Db19DocumentsCreateForeignKeysUserIdStateName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection("mysql_input_doc")->table('documents', function (Blueprint $table) {
            $table->foreign('creator_id')->references('id')->on('users');

            $table->foreign('state_name')->references('name')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection("mysql_input_doc")->table('documents', function (Blueprint $table) {
            $table->dropForeign(['creator_id']);

            $table->dropForeign(['state_name']);
        });
    }
}
