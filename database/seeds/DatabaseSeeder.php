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
        $this->call(CreatePrivileges::class);
        $this->call(SeedingGroupsTable::class);
        $this->call(CreateRoles::class);
        $this->call(FullinPrivilegeRole::class);
        $this->call(CreateAdmin::class);
        $this->call(SeedingGroupTableDb19::class);
        $this->call(Db19States::class);
//        $this->call(Db19types::class);
        $this->call(SeedingTypesTable::class);
        $this->call(SeedingTableOrderColumns::class);
    }
}
