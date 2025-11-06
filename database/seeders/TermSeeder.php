<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $terms = [
            ['name' => 'Spring 2024', 'start_date' => '2024-01-15', 'end_date' => '2024-05-15', 'status' => 0, 'is_publish_categories' => 0],
            ['name' => 'Summer 2024', 'start_date' => '2024-06-01', 'end_date' => '2024-08-15', 'status' => 0, 'is_publish_categories' => 0],
            ['name' => 'Fall 2024', 'start_date' => '2024-09-01', 'end_date' => '2024-12-15', 'status' => 0, 'is_publish_categories' => 0],
            ['name' => 'Spring 2025', 'start_date' => '2025-01-15', 'end_date' => '2025-05-15', 'status' => 0, 'is_publish_categories' => 0],
            ['name' => 'Summer 2025', 'start_date' => '2025-06-01', 'end_date' => '2025-08-15', 'status' => 1, 'is_publish_categories' => 0],
            ['name' => 'Fall 2025', 'start_date' => '2025-09-01', 'end_date' => '2025-12-15', 'status' => 0, 'is_publish_categories' => 0],
        ];

        foreach ($terms as $term) {
            Term::create($term);
        }
    }
}
