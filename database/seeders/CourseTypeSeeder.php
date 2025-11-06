<?php

namespace Database\Seeders;

use App\Models\CourseType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courseTypes = [
            ['name' => 'Theory', 'description' => 'Standard Theory-based course.'],
            ['name' => 'Laboratory', 'description' => 'Hands-on practical course.']
        ];

        foreach ($courseTypes as $type) {
            CourseType::create($type);
        }
    }
}
