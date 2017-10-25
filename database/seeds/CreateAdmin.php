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
        $data[] = 'admin temp';
        $data[] = 'admin';
        $data[] = 'admin';

        DB::insert('insert into users (id, login, password, full_name, group_name, role_name) values (?, ?, ?, ?, ?, ?)', $data);

        $query = "CREATE USER 'admin'@'localhost' IDENTIFIED BY '" . $password . "'";
        \DB::/*connection("mysql_input_doc")->*/unprepared($query);

        $query  = "GRANT ALL PRIVILEGES ON db19_input_doc.* TO 'admin'@'localhost'";
        \DB::/*connection("mysql_input_doc")->*/unprepared($query);

        $query = "GRANT CREATE USER ON *.* TO 'admin'@'localhost' WITH GRANT OPTION";
        \DB::/*connection("mysql_input_doc")->*/unprepared($query);
    }
}
