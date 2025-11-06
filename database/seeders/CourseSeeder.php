<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = array(
            array('id' => '1','term_id' => '5','batch_id' => '1','course_type_id' => '1','teacher_id' => '2','name' => 'Introduction to Computer Science','code' => 'CS101','description' => 'Basic concepts of computer science.','created_at' => '2025-09-27 18:01:57','updated_at' => '2025-09-27 18:01:57'),
            array('id' => '2','term_id' => '5','batch_id' => '1','course_type_id' => '1','teacher_id' => '2','name' => 'Data Structures','code' => 'CS201','description' => 'Study of data organization and manipulation.','created_at' => '2025-09-27 18:01:57','updated_at' => '2025-09-27 18:01:57'),
            array('id' => '3','term_id' => '5','batch_id' => '1','course_type_id' => '2','teacher_id' => '2','name' => 'Database Management Systems','code' => 'CS301','description' => 'Introduction to database systems and SQL.','created_at' => '2025-09-27 18:01:57','updated_at' => '2025-09-27 18:01:57'),
            array('id' => '4','term_id' => '5','batch_id' => '1','course_type_id' => '1','teacher_id' => '2','name' => 'Operating Systems','code' => 'CS501','description' => 'Concepts of operating systems and process management.','created_at' => '2025-09-27 18:01:57','updated_at' => '2025-09-27 18:01:57'),
            array('id' => '5','term_id' => '3','batch_id' => '4','course_type_id' => '1','teacher_id' => '2','name' => 'Haviva Emerson','code' => 'Officiis eum impedit','description' => 'Ea provident tempor','created_at' => '2025-09-27 18:25:32','updated_at' => '2025-09-27 18:27:12'),
            array('id' => '6','term_id' => '2','batch_id' => '4','course_type_id' => '2','teacher_id' => '2','name' => 'Tatum Giles','code' => 'Pariatur Pariatur','description' => 'Commodo et corrupti','created_at' => '2025-09-27 18:25:50','updated_at' => '2025-09-27 18:27:06')
        );

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
