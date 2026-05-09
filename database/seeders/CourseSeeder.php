<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('data/all_courses.csv');

        if (!file_exists($file)) {
            echo "Kesalahan Eksekusi: File CSV tidak ditemukan di database/data/all_courses.csv\n";
            return;
        }

        $open = fopen($file, "r");
        $header = fgetcsv($open, 2000, ";"); 

        $categories = Category::all();
        $instructorIds = User::where('role', 'instructor')->pluck('id')->toArray();

        if ($categories->isEmpty() || empty($instructorIds)) {
            echo "Integritas Gagal: Jalankan CategorySeeder & UserSeeder terlebih dahulu!\n";
            return;
        }

        while (($data = fgetcsv($open, 2000, ";")) !== FALSE) {
            
            $title = mb_convert_encoding($data[1], 'UTF-8', 'ISO-8859-1');
            $subject = mb_convert_encoding($data[10], 'UTF-8', 'ISO-8859-1'); 
            $level = mb_convert_encoding($data[7], 'UTF-8', 'ISO-8859-1');

            $categoryId = $this->determineTopicId($title, $subject, $categories);

            $rawPrice = $data[3];
            if (strtolower(trim($rawPrice)) === 'free') {
                $priceInRupiah = 0;
            } else {
                $cleanPrice = str_replace(['$', ',00', '.'], '', $rawPrice);
                $priceInRupiah = (int) $cleanPrice * 15000;
            }

            // Keyword gambar unsplash
            $keyword = 'education';
            $titleLower = strtolower($title);
            if (Str::contains($titleLower, ['code', 'programming', 'javascript', 'php', 'html', 'css', 'react', 'angular', 'python', 'sql', 'linux', 'cyber'])) {
                $keyword = 'coding,technology';
            } elseif (Str::contains($titleLower, ['music', 'piano', 'guitar', 'instrument'])) {
                $keyword = 'music,instrument';
            } elseif (Str::contains($titleLower, ['business', 'marketing', 'finance', 'trading', 'money', 'excel', 'office'])) {
                $keyword = 'business,office';
            } elseif (Str::contains($titleLower, ['design', 'art', 'drawing', 'photoshop'])) {
                $keyword = 'design,art';
            }

            Course::create([
                'title' => $title, 
                'description' => 'Materi komprehensif mengenai ' . $subject . ' yang dirancang khusus untuk tingkat ' . $level . '.',
                'price' => $priceInRupiah,
                'image_url' => 'https://images.unsplash.com/photo-' . $this->getStaticPhotoId($keyword) . '?auto=format&fit=crop&w=320&h=180&q=80',
                'category_id' => $categoryId,
                'instructor_id' => $instructorIds[array_rand($instructorIds)],
            ]);
        }

        fclose($open);
    }

    private function determineTopicId(string $title, string $subject, $categories): int
    {
        $titleLower = strtolower($title);
        $subjectLower = strtolower($subject);

        // A. DETEKSI SYSTEM & SECURITY (IT & Software)
        if (Str::contains($titleLower, ['powershell', 'linux', 'bash', 'windows server', 'server', 'ubuntu', 'cyber security', 'ethical hacking', 'network', 'ccna', 'security+', 'hack'])) {
            if (Str::contains($titleLower, ['powershell'])) {
                return $categories->firstWhere('name', 'PowerShell')->id;
            }
            if (Str::contains($titleLower, ['linux', 'bash', 'ubuntu'])) {
                return $categories->firstWhere('name', 'Linux Administration')->id;
            }
            if (Str::contains($titleLower, ['windows server', 'server'])) {
                return $categories->firstWhere('name', 'Windows Server')->id;
            }
            if (Str::contains($titleLower, ['hack', 'ethical hacking', 'penetration'])) {
                return $categories->firstWhere('name', 'Ethical Hacking')->id;
            }
            if (Str::contains($titleLower, ['cyber', 'security'])) {
                return $categories->firstWhere('name', 'Cyber Security')->id;
            }
            return $categories->firstWhere('name', 'Computer Networks')->id;
        }

        // B. DETEKSI PRODUCTIVITY TOOLS (Office Productivity)
        if (Str::contains($titleLower, ['excel', 'vba', 'word', 'powerpoint', 'google sheets', 'spreadsheet', 'google drive'])) {
            if (Str::contains($titleLower, ['vba'])) {
                return $categories->firstWhere('name', 'Excel VBA')->id;
            }
            if (Str::contains($titleLower, ['excel'])) {
                return $categories->firstWhere('name', 'Excel Basic')->id;
            }
            if (Str::contains($titleLower, ['sheets', 'spreadsheet'])) {
                return $categories->firstWhere('name', 'Google Sheets')->id;
            }
            if (Str::contains($titleLower, ['powerpoint'])) {
                return $categories->firstWhere('name', 'PowerPoint')->id;
            }
            return $categories->firstWhere('name', 'Microsoft Word')->id;
        }

        // C. DETEKSI PERSONAL DEVELOPMENT
        if (Str::contains($titleLower, ['public speaking', 'interview', 'resume', 'time management', 'memory', 'speed reading', 'motivation', 'career', 'write business'])) {
            if (Str::contains($titleLower, ['time management'])) {
                return $categories->firstWhere('name', 'Time Management')->id;
            }
            if (Str::contains($titleLower, ['memory', 'speed reading'])) {
                return $categories->firstWhere('name', 'Memory & Speed Reading')->id;
            }
            if (Str::contains($titleLower, ['interview'])) {
                return $categories->firstWhere('name', 'Interview Skills')->id;
            }
            if (Str::contains($titleLower, ['public speaking'])) {
                return $categories->firstWhere('name', 'Public Speaking')->id;
            }
            return $categories->firstWhere('name', 'Career Development')->id;
        }

        // D. KATEGORI UTAMA: WEB DEVELOPMENT
        if (Str::contains($subjectLower, ['web development', 'development'])) {
            if (Str::contains($titleLower, ['react'])) {
                return $categories->firstWhere('name', 'React JS')->id ?? $categories->firstWhere('name', 'JavaScript')->id;
            }
            if (Str::contains($titleLower, ['angular'])) {
                return $categories->firstWhere('name', 'Angular')->id ?? $categories->firstWhere('name', 'JavaScript')->id;
            }
            if (Str::contains($titleLower, ['node', 'express'])) {
                return $categories->firstWhere('name', 'Node.js')->id ?? $categories->firstWhere('name', 'JavaScript')->id;
            }
            if (Str::contains($titleLower, ['javascript', 'js', 'typescript'])) {
                return $categories->firstWhere('name', 'JavaScript')->id;
            }
            if (Str::contains($titleLower, ['php', 'laravel'])) {
                return $categories->firstWhere('name', 'PHP & Laravel')->id;
            }
            if (Str::contains($titleLower, ['django', 'python'])) {
                return $categories->firstWhere('name', 'Python Django')->id;
            }
            if (Str::contains($titleLower, ['ruby', 'rails'])) {
                return $categories->firstWhere('name', 'Ruby on Rails')->id;
            }
            return $categories->firstWhere('name', 'HTML & CSS')->id;
        }

        // E. KATEGORI UTAMA: BUSINESS FINANCE
        if (Str::contains($subjectLower, ['business finance', 'finance', 'accounting'])) {
            if (Str::contains($titleLower, ['accounting', 'bookkeeping', 'accountant', 'tally'])) {
                return $categories->firstWhere('name', 'Financial Accounting')->id ?? $categories->firstWhere('name', 'Bookkeeping')->id;
            }
            if (Str::contains($titleLower, ['tax'])) {
                return $categories->firstWhere('name', 'Taxes')->id;
            }
            if (Str::contains($titleLower, ['forex', 'currency'])) {
                return $categories->firstWhere('name', 'Forex Trading')->id;
            }
            if (Str::contains($titleLower, ['stock', 'share', 'saham', 'trading'])) {
                return $categories->firstWhere('name', 'Stock Trading')->id;
            }
            if (Str::contains($titleLower, ['day trade', 'option'])) {
                return $categories->firstWhere('name', 'Day Trading')->id ?? $categories->firstWhere('name', 'Options Trading')->id;
            }
            return $categories->firstWhere('name', 'Investing')->id;
        }

        // F. KATEGORI UTAMA: GRAPHIC DESIGN
        if (Str::contains($subjectLower, ['graphic design', 'design'])) {
            if (Str::contains($titleLower, ['photoshop'])) {
                return $categories->firstWhere('name', 'Adobe Photoshop')->id;
            }
            if (Str::contains($titleLower, ['illustrator', 'vector'])) {
                return $categories->firstWhere('name', 'Adobe Illustrator')->id;
            }
            if (Str::contains($titleLower, ['canva'])) {
                return $categories->firstWhere('name', 'Canva')->id;
            }
            if (Str::contains($titleLower, ['autocad', 'cad'])) {
                return $categories->firstWhere('name', 'AutoCAD')->id;
            }
            if (Str::contains($titleLower, ['solidworks'])) {
                return $categories->firstWhere('name', 'SOLIDWORKS')->id;
            }
            if (Str::contains($titleLower, ['figma', 'ui', 'ux'])) {
                return $categories->firstWhere('name', 'Figma')->id;
            }
            if (Str::contains($titleLower, ['sketchup'])) {
                return $categories->firstWhere('name', 'SketchUp')->id;
            }
            if (Str::contains($titleLower, ['draw', 'paint', 'sketch', 'art'])) {
                return $categories->firstWhere('name', 'Digital Painting')->id;
            }
            return $categories->firstWhere('name', 'Graphic Design')->id;
        }

        // G. KATEGORI UTAMA: MUSICAL INSTRUMENTS
        if (Str::contains($subjectLower, ['musical instruments', 'instruments', 'music'])) {
            if (Str::contains($titleLower, ['guitar', 'gitar'])) {
                return $categories->firstWhere('name', 'Guitar')->id;
            }
            if (Str::contains($titleLower, ['piano'])) {
                return $categories->firstWhere('name', 'Piano')->id;
            }
            if (Str::contains($titleLower, ['keyboard'])) {
                return $categories->firstWhere('name', 'Keyboard')->id;
            }
            if (Str::contains($titleLower, ['bass'])) {
                return $categories->firstWhere('name', 'Bass Guitar')->id;
            }
            if (Str::contains($titleLower, ['ukulele'])) {
                return $categories->firstWhere('name', 'Ukulele')->id;
            }
            if (Str::contains($titleLower, ['theory', 'read music'])) {
                return $categories->firstWhere('name', 'Music Theory')->id;
            }
            if (Str::contains($titleLower, ['compos'])) {
                return $categories->firstWhere('name', 'Music Composition')->id;
            }
            if (Str::contains($titleLower, ['sing', 'vocal', 'voice'])) {
                return $categories->firstWhere('name', 'Vocal & Singing')->id;
            }
            return $categories->firstWhere('name', 'Music Theory')->id;
        }

        return $categories->random()->id;
    }

    private function getStaticPhotoId(string $keyword): string
    {
        $photos = [
            'coding,technology' => [
                '1587629197415-2ab68d7a52b7', '1498050108023-c5249f4df085', '1555066931-4365d14bab8c'
            ],
            'music,instrument' => [
                '1511671782779-c97d3d27a1d4', '1520523839897-bd0b52f945a0', '1510915361894-db8b60106cb1'
            ],
            'business,office' => [
                '1460925895917-afdab827c52f', '1454165804606-c3d57bc86b40', '1590283603385-17ffb3a7f29f'
            ],
            'design,art' => [
                '1550684848-fac1c5b4e853', '1513542789411-b6a5d4f31634', '1561070791-2526d30994b5'
            ],
            'education' => [
                '1503676260728-1c00da094a0b', '1427504494785-3a9ca7044f45', '1434030216411-0b793f4b4173'
            ]
        ];

        $list = $photos[$keyword] ?? $photos['education'];
        return $list[array_rand($list)];
    }
}