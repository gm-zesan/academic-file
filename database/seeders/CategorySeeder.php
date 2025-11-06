<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = array(
            array('id' => '1','parent_id' => NULL,'course_type_id' => '1','term_id' => '5','name' => 'Best Auraa','allowed_upload' => '0','created_at' => '2025-09-28 18:57:23','updated_at' => '2025-09-28 18:57:23'),
            array('id' => '2','parent_id' => '1','course_type_id' => '1','term_id' => '5','name' => 'Headphones','allowed_upload' => '1','created_at' => '2025-09-28 18:57:30','updated_at' => '2025-09-28 18:57:51'),
            array('id' => '3','parent_id' => '1','course_type_id' => '1','term_id' => '5','name' => 'Watch','allowed_upload' => '0','created_at' => '2025-09-28 18:57:38','updated_at' => '2025-09-28 18:57:38'),
            array('id' => '4','parent_id' => '3','course_type_id' => '1','term_id' => '5','name' => 'Hasan','allowed_upload' => '1','created_at' => '2025-09-28 20:54:41','updated_at' => '2025-09-28 20:54:41'),
            array('id' => '5','parent_id' => NULL,'course_type_id' => '2','term_id' => '5','name' => 'Lab task','allowed_upload' => '1','created_at' => '2025-11-05 16:36:05','updated_at' => '2025-11-05 16:46:46')
        );

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
