<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Chairperson',
            'email' => 'chairperson@gmail.com',
            'password' => bcrypt('chairperson'),
            'current_term_id' => 5,
        ]);
        $user = User::create([
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'password' => bcrypt('teacher'),
        ]);

        $adminPermissions = Permission::pluck('id','name')->all();
        $admin->assignRole('admin');
        $adminRole = Role::findByName('admin');
        $adminRole->givePermissionTo($adminPermissions);

        $userPermissions = [
            'course-list',
            'file-list',
            'file-upload',
        ];
        $user->assignRole('user');
        $userRole = Role::findByName('user');
        $userRole->givePermissionTo($userPermissions);
    }
}
