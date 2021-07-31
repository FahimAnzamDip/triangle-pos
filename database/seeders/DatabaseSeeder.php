<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Database\Seeders\SettingDatabaseSeeder;
use Modules\User\Database\Seeders\PermissionsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsTableSeeder::class);
        $this->call(SuperUserSeeder::class);
        $this->call(SettingDatabaseSeeder::class);
    }
}
