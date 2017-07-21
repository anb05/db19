<?php

use Illuminate\Database\Seeder;

class BindRoleUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert(
            [
                'user_id' => '1000000000',
                'role_id' => '100',
            ]
        );
    }
}
