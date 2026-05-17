<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            'Development' => [
                // FAKTANYA: Sesuai dengan subjek "Web Development" di CSV
                'Web Development' => ['HTML & CSS', 'JavaScript', 'React JS', 'PHP & Laravel', 'Python Django']
            ],
            'Business & Finance' => [
                // FAKTANYA: Diubah menjadi "Business Finance" agar klop dengan teks CSV
                'Business Finance' => ['Accounting', 'Financial Accounting', 'Taxes', 'Stock Trading', 'Forex Trading']
            ],
            'Design' => [
                // FAKTANYA: Sesuai dengan subjek "Graphic Design" di CSV
                'Graphic Design' => ['Adobe Photoshop', 'Adobe Illustrator', 'Canva', '3D Design', 'AutoCAD']
            ],
            'Music' => [
                // FAKTANYA: Sesuai dengan subjek "Musical Instruments" di CSV
                'Musical Instruments' => ['Guitar', 'Piano', 'Ukulele', 'Vocal & Singing']
            ],
            'IT & Software' => [
                // FAKTANYA: Diubah menjadi "Cyber Security" agar klop dengan teks CSV
                'Cyber Security' => ['Network Security', 'Ethical Hacking'] 
            ],
            'Office Productivity' => [
                // FAKTANYA: Sesuai dengan subjek "Excel Basic" di CSV
                'Excel Basic' => ['Excel Advanced', 'PowerPoint', 'Microsoft Word']
            ],
            'Personal Development' => [
                // FAKTANYA: Sesuai dengan subjek "Public Speaking" di CSV
                'Public Speaking' => ['Time Management', 'Interview Skills']
            ]
        ];

        foreach ($data as $mainName => $subCategories) {
            $main = Category::updateOrCreate(
                ['slug' => Str::slug($mainName)],
                ['name' => $mainName]
            );

            foreach ($subCategories as $subName => $topics) {
                $subSlug = Str::slug($mainName . '-' . $subName);
                
                $sub = Category::updateOrCreate(
                    ['slug' => $subSlug],
                    ['name' => $subName, 'parent_id' => $main->id]
                );

                foreach ($topics as $topicName) {
                    $topicSlug = Str::slug($subName . '-' . $topicName);

                    Category::updateOrCreate(
                        ['slug' => $topicSlug],
                        ['name' => $topicName, 'parent_id' => $sub->id]
                    );
                }
            }
        }
    }
}