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

        // Struktur Kategori 3-Tingkat (7 Kategori Induk Baru yang 100% sesuai CSV)
        $data = [
            'Development' => [
                'Web Development' => ['HTML & CSS', 'JavaScript', 'React JS', 'Angular', 'Node.js', 'PHP & Laravel', 'Python Django', 'Ruby on Rails']
            ],
            'Business & Finance' => [
                'Investing & Trading' => ['Stock Trading', 'Investing', 'Forex Trading', 'Day Trading', 'Options Trading'],
                'Accounting' => ['Bookkeeping', 'Financial Accounting', 'Financial Statements', 'Taxes']
            ],
            'Design' => [
                'Graphic Design' => ['Graphic Design', 'Adobe Illustrator', 'Adobe Photoshop', 'Canva', 'Digital Painting'],
                'Design Tools' => ['AutoCAD', 'SOLIDWORKS', 'Figma', 'SketchUp']
            ],
            'Music' => [
                'Instruments' => ['Guitar', 'Piano', 'Keyboard', 'Bass Guitar', 'Ukulele'],
                'Music Fundamentals' => ['Music Theory', 'Music Composition', 'Music Reading', 'Vocal & Singing']
            ],
            'IT & Software' => [
                'Operating Systems' => ['Linux Administration', 'Windows Server', 'PowerShell', 'Shell Scripting'],
                'Network & Security' => ['Ethical Hacking', 'Cyber Security', 'Computer Networks', 'CCNA']
            ],
            'Office Productivity' => [
                'Microsoft Office' => ['Excel Basic', 'Excel VBA', 'PowerPoint', 'Microsoft Word'],
                'Google Suite' => ['Google Sheets', 'Google Workspace', 'Google Drive']
            ],
            'Personal Development' => [
                'Productivity' => ['Time Management', 'Memory & Speed Reading', 'Focus & Motivation'],
                'Career Development' => ['Interview Skills', 'Public Speaking', 'Business Writing', 'Resume Guide']
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