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
                'Web Development' => ['HTML & CSS', 'JavaScript', 'React JS', 'PHP & Laravel', 'Python Django']
            ],
            'Business & Finance' => [
                'Accounting' => ['Financial Accounting', 'Taxes'],
                'Trading' => ['Stock Trading', 'Forex Trading']
            ],
            'Design' => [
                'Graphic Design' => ['Adobe Photoshop', 'Adobe Illustrator', 'Canva'],
                '3D Design' => ['AutoCAD', 'SOLIDWORKS']
            ],
            'Music' => [
                'Instruments' => ['Guitar', 'Piano', 'Ukulele'],
                'Vocals' => ['Vocal & Singing']
            ],
            'IT & Software' => [
                'Network & Security' => ['Cyber Security', 'Ethical Hacking'] 
            ],
            'Office Productivity' => [
                'Microsoft Office' => ['Excel Basic', 'PowerPoint', 'Microsoft Word']
            ],
            'Personal Development' => [
                'Career & Productivity' => ['Public Speaking', 'Time Management', 'Interview Skills']
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