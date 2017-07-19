<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePrivilegesOfRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privileges_of_role', function (Blueprint $table) {
//            $table->increments('id');
            $table->unsignedInteger('privilege');
            $table->unsignedInteger('role');
//            $table->timestamps();

            $table->foreign('privilege')
                ->references('id')->on('privileges');

            $table->foreign('role')
                ->references('id')->on('roles');
        });

        DB::unprepared('ALTER TABLE privileges_of_role ADD UNIQUE (privilege, role)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privileges_of_role');
    }
}
