<?php

use Illuminate\Database\Seeder;

/**
 * Class SeedingGroupsTable
 * This class will be seeding data to groups table.
 */
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
                     никаких ролей. Группа меняется при регистрации пользователя в БД.
                     Во всех остальных группах автоматически существует роль просмотра
                     служебной информации о документах из записей (через доступ к Представлению)'
                ],

                [
                    'id' => 2,
                    'name' => 'section_11',
                    'description' => 'Группа пользователей 11 отдела'
                ],

                [
                    'id' => 3,
                    'name' => 'section_12',
                    'description' => 'Группа пользователей 12 отдела'
                ],

                [
                    'id' => 4,
                    'name' => 'section_13',
                    'description' => 'Группа пользователей 13 отдела'
                ],

                [
                    'id' => 5,
                    'name' => 'section_21',
                    'description' => 'Группа пользователей 21 отдела'
                ],

                [
                    'id' => 6,
                    'name' => 'section_22',
                    'description' => 'Группа пользователей 22 отдела'
                ],

                [
                    'id' => 7,
                    'name' => 'section_23',
                    'description' => 'Группа пользователей 23 отдела'
                ],

                [
                    'id' => 8,
                    'name' => 'section_31',
                    'description' => 'Группа пользователей 31 отдела'
                ],

                [
                    'id' => 9,
                    'name' => 'section_32',
                    'description' => 'Группа пользователей 32 отдела'
                ],

                [
                    'id' => 10,
                    'name' => 'section_33',
                    'description' => 'Группа пользователей 33 отдела'
                ],

                [
                    'id' => 11,
                    'name' => 'section_so',
                    'description' => 'Группа пользователей научно-организационного отдела'
                ],

                [
                    'id' => 12,
                    'name' => 'section_fin',
                    'description' => 'Группа пользователей финансового отдела'
                ],

                [
                    'id' => 13,
                    'name' => 'section_g',
                    'description' => 'Группа пользователей секретной части'
                ],

                [
                    'id' => 14,
                    'name' => 'section_adm',
                    'description' => 'Группа пользователей административного отдела'
                ],

                [
                    'id' => 15,
                    'name' => 'section_mt',
                    'description' => 'Группа пользователей материально-технического обеспечения'
                ],

                [
                    'id' => 16,
                    'name' => 'section_ch',
                    'description' => 'Группа пользователей дежурной службы'
                ],

                [
                    'id' => 17,
                    'name' => 'unit',
                    'description' => 'Группа начальников управлений'
                ],

                [
                    'id' => 18,
                    'name' => 'unit_1',
                    'description' => 'Начальник 1 управления'
                ],

                [
                    'id' => 19,
                    'name' => 'unit_2',
                    'description' => 'Начальник 2 управления'
                ],

                [
                    'id' => 20,
                    'name' => 'unit_3',
                    'description' => 'Начальник 3 управления'
                ],

                [
                    'id' => 21,
                    'name' => 'leadership',
                    'description' => 'Руководство'
                ],

                [
                    'id' => 100,
                    'name' => 'admin',
                    'description' => 'Группа администраторов приложения'
                ],
            ]
        );
    }
}
