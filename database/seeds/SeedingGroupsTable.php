<?php

use Illuminate\Database\Seeder;

class SeedingGroupsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'guest',
                    'description' => 'Начальная группа. Присваивается при регистрации
                     пользователя в системе. Пользователи этой группы не имеют
                     никаких прав. Группа меняется при регистрации пользователя в БД'
                ],

                [
                    'id' => 100,
                    'name' => 'admin',
                    'description' => 'Группа администраторов приложения'
                ],

                [
                    'id' => 2,
                    'name' => 'section_11',
                    'description' => 'Группа пользователей 11 отдела'
                ],
            ]
        );
    }
}

