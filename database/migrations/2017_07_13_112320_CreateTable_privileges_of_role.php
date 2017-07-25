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
        Schema::create('privilege_role', function (Blueprint $table) {
//            $table->increments('id');
            $table->string('privilege_name');
            $table->string('role_name');
//            $table->timestamps();

            $table->foreign('privilege_name')
                ->references('name')->on('privileges');

            $table->foreign('role_name')
                ->references('name')->on('roles');
        });

        DB::unprepared('ALTER TABLE privilege_role ADD PRIMARY KEY (privilege_name, role_name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privilege_role');
    }
}
