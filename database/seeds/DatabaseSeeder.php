<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CreatePrivileges::class);
        $this->call(SeedingGroupsTable::class);
        $this->call(CreateRoles::class);
        $this->call(FullinPrivilegeRole::class);
        $this->call(CreateAdmin::class);
    }
}
