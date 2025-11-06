<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionTableSeeder::class,
            TermSeeder::class,
            BatchSeeder::class,
            UserSeeder::class,
            CourseTypeSeeder::class,
            CourseSeeder::class,
            CategorySeeder::class,
            FileSeeder::class,
        ]);
    }
}
