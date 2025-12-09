<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed permissions and roles first
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            AdminTableSeeder::class,
            UserTableSeeder::class,
        ]);
    }
}
