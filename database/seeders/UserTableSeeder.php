<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_superadmin = Role::where('name', 'superadmin')->first();
        $user = [
         [
             'name' => 'Admin',
             'role_id'=> 1,
             'email' => 'admin@admin.com',
             'region_id' => 1,
             'last_name' => 'Admin',
             'username' => 'Admin',
             'profile_photo' => '1608069288perfil-empresario-dibujos-animados_18591-58479.jpg',
            'password' => bcrypt('12345678'),
         ],
     ];
     User::insert($user);
    }
}
