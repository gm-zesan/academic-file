<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $files = array(
            array('id' => '1','category_id' => '2','course_id' => '1','uploaded_by' => '1','file_path' => 'uploads/files/SITW79GX2k2v7f8fmeaYkj9ptzgqomAjbxUfxWeM.pdf','original_name' => 'GMZesanResume.pdf','mime_type' => 'application/pdf','size' => '213374','approved' => '1','created_at' => '2025-09-28 20:12:34','updated_at' => '2025-09-28 20:12:34'),
            array('id' => '2','category_id' => '4','course_id' => '2','uploaded_by' => '1','file_path' => 'uploads/files/KoiUtcbswb8gR6ltkipSIjNnyS7VbK7WH80M8k2e.pdf','original_name' => 'GMZesanResume.pdf','mime_type' => 'application/pdf','size' => '213374','approved' => '1','created_at' => '2025-09-28 21:17:20','updated_at' => '2025-09-28 21:17:20'),
            array('id' => '3','category_id' => '2','course_id' => '2','uploaded_by' => '1','file_path' => 'uploads/files/vrF4OGODS0E6DTK1aRSWTue9KLV5O9V4UBmwPraq.pdf','original_name' => 'G.M. Zesan (CV).pdf','mime_type' => 'application/pdf','size' => '220805','approved' => '1','created_at' => '2025-09-28 21:18:35','updated_at' => '2025-09-28 21:18:35'),
            array('id' => '4','category_id' => '4','course_id' => '3','uploaded_by' => '1','file_path' => 'uploads/files/AVdMpWScE3wIXihibteCNvdrjWicbPCWrn7LNQ0j.pdf','original_name' => 'G.M. Zesan (CV).pdf','mime_type' => 'application/pdf','size' => '220805','approved' => '1','created_at' => '2025-09-28 21:19:23','updated_at' => '2025-09-28 21:19:23'),
            array('id' => '5','category_id' => '2','course_id' => '4','uploaded_by' => '1','file_path' => 'uploads/files/VwgFo6zBPxVwuEeLp6DxfDi6dz7EfpghonpogRyG.jpg','original_name' => 'WhatsApp Image 2025-11-05 at 01.58.28_a33f21d8.jpg','mime_type' => 'image/jpeg','size' => '222546','approved' => '1','created_at' => '2025-11-05 14:54:14','updated_at' => '2025-11-05 14:54:14')
        );

        foreach ($files as $file) {
            File::create($file);
        }
    }
}
