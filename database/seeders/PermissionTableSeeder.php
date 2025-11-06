<?php



namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;



class PermissionTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $permissions = [

            // term module
            ['name' => 'term-list', 'display_name' => 'Term list', 'module' => 'term'],
            ['name' => 'term-create', 'display_name' => 'Term create', 'module' => 'term'],
            ['name' => 'term-edit', 'display_name' => 'Term edit', 'module' => 'term'],
            ['name' => 'term-delete', 'display_name' => 'Term delete', 'module' => 'term'],

            // batch module
            ['name' => 'batch-list', 'display_name' => 'Batch list', 'module' => 'batch'],
            ['name' => 'batch-create', 'display_name' => 'Batch create', 'module' => 'batch'],
            ['name' => 'batch-edit', 'display_name' => 'Batch edit', 'module' => 'batch'],
            ['name' => 'batch-delete', 'display_name' => 'Batch delete', 'module' => 'batch'],

            // teacher module
            ['name' => 'teacher-list', 'display_name' => 'Teacher list', 'module' => 'teacher'],
            ['name' => 'teacher-create', 'display_name' => 'Teacher create', 'module' => 'teacher'],
            ['name' => 'teacher-edit', 'display_name' => 'Teacher edit', 'module' => 'teacher'],
            ['name' => 'teacher-delete', 'display_name' => 'Teacher delete', 'module' => 'teacher'],

            // course-type module
            ['name' => 'course-type-list', 'display_name' => 'Course Type list', 'module' => 'course-type'],
            ['name' => 'course-type-create', 'display_name' => 'Course Type create', 'module' => 'course-type'],
            ['name' => 'course-type-edit', 'display_name' => 'Course Type edit', 'module' => 'course-type'],
            ['name' => 'course-type-delete', 'display_name' => 'Course Type delete', 'module' => 'course-type'],

            // course module
            ['name' => 'course-list', 'display_name' => 'Course list', 'module' => 'course'],
            ['name' => 'course-create', 'display_name' => 'Course create', 'module' => 'course'],
            ['name' => 'course-edit', 'display_name' => 'Course edit', 'module' => 'course'],
            ['name' => 'course-delete', 'display_name' => 'Course delete', 'module' => 'course'],

            // category module
            ['name' => 'category-list', 'display_name' => 'Category list', 'module' => 'category'],
            ['name' => 'category-create', 'display_name' => 'Category create', 'module' => 'category'],
            ['name' => 'category-edit', 'display_name' => 'Category edit', 'module' => 'category'],
            ['name' => 'category-delete', 'display_name' => 'Category delete', 'module' => 'category'],

            // file module
            ['name' => 'file-list', 'display_name' => 'File list', 'module' => 'file'],
            ['name' => 'file-upload', 'display_name' => 'File upload', 'module' => 'file'],
            ['name' => 'file-monitor', 'display_name' => 'File monitor', 'module' => 'file'],

            // request module
            ['name' => 'request-list', 'display_name' => 'Request list', 'module' => 'request'],
            ['name' => 'request-update', 'display_name' => 'Request update', 'module' => 'request'],

            


            // role
            ['name' => 'role-list', 'display_name' => 'Role list', 'module' => 'role'],
            ['name' => 'role-create', 'display_name' => 'Role create', 'module' => 'role'],
            ['name' => 'role-edit', 'display_name' => 'Role edit', 'module' => 'role'],
            ['name' => 'role-delete', 'display_name' => 'Role delete', 'module' => 'role'],

            // assign-role
            ['name' => 'assign-role', 'display_name' => 'Assign Role', 'module' => 'assign-role'],

            // user
            ['name' => 'user-list', 'display_name' => 'User list', 'module' => 'user'],
            ['name' => 'user-create', 'display_name' => 'User create', 'module' => 'user'],
            ['name' => 'user-edit', 'display_name' => 'User edit', 'module' => 'user'],
            ['name' => 'user-delete', 'display_name' => 'User delete', 'module' => 'user'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }

}
