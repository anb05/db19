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
        $data[] = '1000000000';
        $data[] = 'admin';
        $password = '_admin_';
        $data[] = bcrypt($password);
//        $data[] = time();
//        $data[] = time();
        $data[] = 100;

        DB::insert('insert into users (id, login, password, group_id) values (?, ?, ?, ?)', $data);
    }
}
