<?php

use Illuminate\Database\Seeder;

class FullinPrivilegeRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privilege_role')->insert(
            [
                [
                    'role_name'      => 'guest',
                    'privilege_name' => 'read_open',
                ],



                [
                    'role_name'      => 'viewer',
                    'privilege_name' => 'read_open',
                ],

                [
                    'role_name'      => 'viewer',
                    'privilege_name' => 'read_mi',
                ],



                [
                    'role_name'      => 'regular',
                    'privilege_name' => 'read_open',
                ],

                [
                    'role_name'      => 'regular',
                    'privilege_name' => 'read_mi',
                ],

                [
                    'role_name'      => 'regular',
                    'privilege_name' => 'read_doc',
                ],



                [
                    'role_name'      => 'writer',
                    'privilege_name' => 'read_open',
                ],

                [
                    'role_name'      => 'writer',
                    'privilege_name' => 'read_mi',
                ],

                [
                    'role_name'      => 'writer',
                    'privilege_name' => 'read_doc',
                ],

                [
                    'role_name'      => 'writer',
                    'privilege_name' => 'create_doc',
                ],



                [
                    'role_name'      => 'moderator',
                    'privilege_name' => 'read_open',
                ],

                [
                    'role_name'      => 'moderator',
                    'privilege_name' => 'read_mi',
                ],

                [
                    'role_name'      => 'moderator',
                    'privilege_name' => 'read_doc',
                ],

                [
                    'role_name'      => 'moderator',
                    'privilege_name' => 'create_doc',
                ],

                [
                    'role_name'      => 'moderator',
                    'privilege_name' => 'redact_doc',
                ],

                [
                    'role_name'      => 'moderator',
                    'privilege_name' => 'drop_doc',
                ],



                [
                    'role_name'      => 'admin',
                    'privilege_name' => 'read_open',
                ],

                [
                    'role_name'      => 'admin',
                    'privilege_name' => 'read_mi',
                ],

                [
                    'role_name'      => 'admin',
                    'privilege_name' => 'read_doc',
                ],

                [
                    'role_name'      => 'admin',
                    'privilege_name' => 'create_user',
                ],

                [
                    'role_name'      => 'admin',
                    'privilege_name' => 'read_user',
                ],

                [
                    'role_name'      => 'admin',
                    'privilege_name' => 'redact_user',
                ],

                [
                    'role_name'      => 'admin',
                    'privilege_name' => 'drop_user',
                ],
            ]
        );
    }
}
