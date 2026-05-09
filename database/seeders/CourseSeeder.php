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
            if (Str::contains($titleLower, ['code', 'programming', 'javascript', 'php', 'html', 'css', 'react', 'angular', 'python', 'sql'])) {
                $keyword = 'coding,technology';
            } elseif (Str::contains($titleLower, ['music', 'piano', 'guitar', 'instrument'])) {
                $keyword = 'music,instrument';
            } elseif (Str::contains($titleLower, ['business', 'marketing', 'finance', 'trading', 'money', 'excel'])) {
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
        $randomFallbackId = $categories->random()->id;

        // ==========================================
        // A. DETEKSI OFFICE PRODUCTIVITY (Excel, Word, PowerPoint)
        // ==========================================
        if (Str::contains($titleLower, ['excel', 'word', 'powerpoint', 'vba', 'macro'])) {
            if (Str::contains($titleLower, ['powerpoint'])) {
                return $categories->firstWhere('name', 'PowerPoint')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['word'])) {
                return $categories->firstWhere('name', 'Microsoft Word')->id ?? $randomFallbackId;
            }
            return $categories->firstWhere('name', 'Excel Basic')->id ?? $randomFallbackId;
        }

        // ==========================================
        // B. DETEKSI IT & SOFTWARE (Cyber Security, Network, Ethical Hacking)
        // ==========================================
        if (Str::contains($titleLower, ['cyber', 'security', 'hack', 'network', 'cisco', 'ccna', 'firewall'])) {
            if (Str::contains($titleLower, ['hack', 'penetration', 'ethical'])) {
                return $categories->firstWhere('name', 'Ethical Hacking')->id ?? $randomFallbackId;
            }
            return $categories->firstWhere('name', 'Cyber Security')->id ?? $randomFallbackId;
        }

        // ==========================================
        // C. DETEKSI PERSONAL DEVELOPMENT (Time Management, Public Speaking, Interview)
        // ==========================================
        if (Str::contains($titleLower, ['time', 'productivity', 'procrastination', 'speak', 'present', 'interview', 'resume', 'career'])) {
            if (Str::contains($titleLower, ['time', 'productivity', 'procrastination'])) {
                return $categories->firstWhere('name', 'Time Management')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['speak', 'present', 'public'])) {
                return $categories->firstWhere('name', 'Public Speaking')->id ?? $randomFallbackId;
            }
            return $categories->firstWhere('name', 'Interview Skills')->id ?? $randomFallbackId;
        }

        // ==========================================
        // D. KATEGORI UTAMA: DEVELOPMENT (Web Development)
        // ==========================================
        if (Str::contains($subjectLower, ['web development', 'development'])) {
            if (Str::contains($titleLower, ['react', 'next'])) {
                return $categories->firstWhere('name', 'React JS')->id ?? $categories->firstWhere('name', 'JavaScript')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['javascript', 'js', 'typescript', 'node', 'angular'])) {
                return $categories->firstWhere('name', 'JavaScript')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['php', 'laravel'])) {
                return $categories->firstWhere('name', 'PHP & Laravel')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['django', 'python'])) {
                return $categories->firstWhere('name', 'Python Django')->id ?? $randomFallbackId;
            }
            return $categories->firstWhere('name', 'HTML & CSS')->id ?? $randomFallbackId;
        }

        // ==========================================
        // E. KATEGORI UTAMA: BUSINESS & FINANCE
        // ==========================================
        if (Str::contains($subjectLower, ['business finance', 'finance', 'accounting'])) {
            if (Str::contains($titleLower, ['accounting', 'bookkeeping', 'accountant', 'tally', 'statement'])) {
                return $categories->firstWhere('name', 'Financial Accounting')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['tax', 'taxes'])) {
                return $categories->firstWhere('name', 'Taxes')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['forex', 'currency'])) {
                return $categories->firstWhere('name', 'Forex Trading')->id ?? $randomFallbackId;
            }
            return $categories->firstWhere('name', 'Stock Trading')->id ?? $randomFallbackId;
        }

        // ==========================================
        // F. KATEGORI UTAMA: GRAPHIC DESIGN (Design)
        // ==========================================
        if (Str::contains($subjectLower, ['graphic design', 'design'])) {
            if (Str::contains($titleLower, ['photoshop'])) {
                return $categories->firstWhere('name', 'Adobe Photoshop')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['illustrator', 'vector'])) {
                return $categories->firstWhere('name', 'Adobe Illustrator')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['canva'])) {
                return $categories->firstWhere('name', 'Canva')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['autocad', 'cad'])) {
                return $categories->firstWhere('name', 'AutoCAD')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['solidworks'])) {
                return $categories->firstWhere('name', 'SOLIDWORKS')->id ?? $randomFallbackId;
            }
            return $categories->firstWhere('name', 'Adobe Photoshop')->id ?? $randomFallbackId;
        }

        // ==========================================
        // G. KATEGORI UTAMA: MUSICAL INSTRUMENTS (Music)
        // ==========================================
        if (Str::contains($subjectLower, ['musical instruments', 'instruments', 'music'])) {
            if (Str::contains($titleLower, ['guitar', 'gitar', 'bass'])) {
                return $categories->firstWhere('name', 'Guitar')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['piano', 'keyboard'])) {
                return $categories->firstWhere('name', 'Piano')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['ukulele'])) {
                return $categories->firstWhere('name', 'Ukulele')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['sing', 'vocal', 'voice'])) {
                return $categories->firstWhere('name', 'Vocal & Singing')->id ?? $randomFallbackId;
            }
            return $categories->firstWhere('name', 'Piano')->id ?? $randomFallbackId;
        }

        return $randomFallbackId;
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