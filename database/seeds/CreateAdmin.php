<?php

use Illuminate\Database\Seeder;

class CreateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data[] = 'admin';
        $password = '_admin_';
        $data[] = bcrypt($password);

        DB::insert('insert into users (login, password) values (?, ?)', $data);
    }
}
