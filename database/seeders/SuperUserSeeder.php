<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super.admin@test.com',
            'password' => Hash::make(12345678),
            'is_active' => 1
        ]);

        $superAdmin = Role::create([
            'name' => 'Super Admin'
        ]);

        $user->assignRole($superAdmin);
    }
}
