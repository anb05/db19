<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePrivilege extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges', function (Blueprint $table) {
//            $table->increments('id');
            $table->string('name')->primary();
            $table->text('description');
//            $table->unsignedInteger('role_id');
//            $table->timestamps();
        });

//        schema::table('privileges', function (blueprint $table) {
//            $table->foreign('role_id')->references('id')->on('roles');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privileges');
    }
}
