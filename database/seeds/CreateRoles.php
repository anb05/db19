<?php

use Illuminate\Database\Seeder;

/**
 * Class CreateRoles
 * This class will be seeding data to roles table.
 */
class CreateRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                [
//                    'id'          => '1',
                    'name'        => 'guest',
                    'description' => 'Роль назначаемая пользователям группы для просмотра открытых не подлежащий
                                      учёту документов. Привилегии: read_open',
                ],

                [
//                    'id'          => '2',
                    'name'        => 'viewer',
                    'description' => 'Роль имеет привилегии как в guest и  назначаемая пользователям для разрешения
                                      чтения всей всей служебной информации о записях, разрещённых для группы.
                                      Привилегии: read_open; read_mi',
                ],

                [
//                    'id'          => '3',
                    'name'        => 'regular',
                    'description' => 'Роль назначаемая пользователям для разрешения чтения всей записи, разрещённой 
                                      для группы в которую он входит. Так же включены все привилегии группы viewer.
                                      Привилегии: read_open; read_mi; read_doc',
                ],

                [
//                    'id'          => '4',
                    'name'        => 'writer',
                    'description' => 'Роль назначаемая пользователям которые могут создавать записи в БД.
                                      Обладает привилегиями regular. Особ с этой ролью целесообразно всключать
                                      в группы управлений (unit_x).
                                      Привилегии: read_open; read_mi; read_doc; create.',
                ],

                [
//                    'id'          => '5',
                    'name'        => 'moderator',
                    'description' => 'Роль назначаемая пользователям, которые проверяют созданные записи на 
                                      правильность заполнения. После проверки, люди с этой ролью разрешают 
                                      отображать запись для пользователей. Также пользователи с этой ролью могут 
                                      редактировать любую запись или удалять. Эта роль обычно назначается
                                      должностным лицам строевой части (section_adm).
                                      Привилегии: read_open; read_mi; read_doc; create; redact; drop.',
                ],

                [
//                    'id'          => '100',
                    'name'        => 'admin',
                    'description' => 'Роль назначаемая пользователям администраторам БД.
                                      Основное прдназначение роли - предоставить права по 
                                      добавлению новых пользователей БД.
                                      Привилегии: read_open; read_me; read_doc; create_user; read_user; update_user; 
                                      drop_user.',
                ],
            ]
        );
    }
}
