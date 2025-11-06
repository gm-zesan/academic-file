<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batches = array(
            array('name' => '211'),
            array('name' => '212'),
            array('name' => '213'),
            array('name' => '221'),
            array('name' => '222'),
            array('name' => '223'),
            array('name' => '231'),
            array('name' => '232'),
            array('name' => '233'),
            array('name' => '241'),
            array('name' => '242'),
            array('name' => '243'),
            array('name' => '251'),
            
        );

        foreach ($batches as $batch) {
            Batch::create($batch);
        }
    }
}
