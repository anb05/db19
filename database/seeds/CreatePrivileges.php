<?php

use Illuminate\Database\Seeder;

class CreatePrivileges extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privileges')->insert(
            [
                [
//                    'id'          => '1',
                    'name'        => 'read_open',
                    'description' => 'Привелегия предоставляет возможность чтения справочной и другой информации 
                                      из информационных ресурсов не стоящих на учёте, например, Законы Украины,
                                      методические рекомендации Яблоковой, шаблоны различных рапортов и документов.',
                ],

                [
//                    'id'          => '2',
                    'name'        => 'read_mi',
                    'description' => 'Привилегия предоставляет возможность чтения служебной информации всех записей  о
                                      документах зарегистрированых в административном отделе',
                ],

                [
//                    'id'          => '3',
                    'name'        => 'read_doc',
                    'description' => 'Привелегия предоставляет возможность чтения всей записи из списка доступних.
                                      Доступ к записи определется принадлежностью к группе. Наименование группы
                                      совпадает с наименованием Представления (view) базы данных посредством которого
                                      информация предоставляется пользователю',
                ],

                [
//                    'id'          => '4',
                    'name'        => 'create',
                    'description' => 'Привелегия предназначена для создания записи в базе данных. Пользователь с
                                      данной привилегией не может просматривать никакой информации других записей',
                ],

                [
//                    'id'          => '5',
                    'name'        => 'redact',
                    'description' => 'Привелегия предназначена для редактирования записей в базе данных.',
                ],

                [
//                    'id'          => '6',
                    'name'        => 'drop',
                    'description' => 'Привелегия предназначена для мягкого удаления записей в базе данных. 
                                      Пользователь с данной привилегией может просматривать все без исключения записи.
                                      Мягкое удаление предполагает удаление записи из обработки приложением. Из базы 
                                      данных запись не удаляется',
                ],

                [
//                    'id'          => '7',
                    'name'        => 'create_user',
                    'description' => 'Привелегия предназначена для создания новой учётной записи пользователя',
                ],

                [
//                    'id'          => '8',
                    'name'        => 'read_user',
                    'description' => 'Привелегия предназначена для просмотра учётной записи пользователя',
                ],

                [
//                    'id'          => '9',
                    'name'        => 'redact_user',
                    'description' => 'Привелегия предназначена для редактирования учётной записи пользователя',
                ],

                [
//                    'id'          => '10',
                    'name'        => 'drop_user',
                    'description' => 'Привилегия предназначена для мягкого удаления учётной записи пользователя',
                ],
            ]
        );
    }
}
