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
            echo "Kesalahan Eksekusi: File CSV tidak ditemukan!\n";
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
            if (!isset($data[1]) || empty($data[1])) {
                continue;
            }
            
            // Atasi masalah pembersihan teks tanda kutip ganda CSV
            $title = trim(mb_convert_encoding($data[1], 'UTF-8', 'ISO-8859-1'), '"');
            $subject = trim(mb_convert_encoding($data[10], 'UTF-8', 'ISO-8859-1'), '"'); 
            $level = trim(mb_convert_encoding($data[7], 'UTF-8', 'ISO-8859-1'), '"');

            $categoryId = $this->determineTopicId($title, $subject, $categories);

            $rawPrice = $data[3];
            if (strtolower(trim($rawPrice)) === 'free') {
                $priceInRupiah = 0;
            } else {
                $cleanPrice = str_replace(['$', ',00', '.', '"'], '', $rawPrice);
                $priceInRupiah = (int) $cleanPrice * 15000;
            }

            // Pilih Keyword Gambar Unsplash
            $keyword = 'general_education';
            $titleLower = strtolower($title);
            if (Str::contains($titleLower, ['react', 'next', 'angular', 'javascript', 'js', 'typescript', 'node', 'html', 'css', 'php', 'laravel', 'django', 'python', 'programming', 'code', 'sql'])) {
                $keyword = 'coding';
            } elseif (Str::contains($titleLower, ['cyber', 'security', 'hack', 'ethical', 'firewall', 'network', 'cisco'])) {
                $keyword = 'cybersecurity';
            } elseif (Str::contains($titleLower, ['accounting', 'bookkeeping', 'tax', 'taxes', 'statement'])) {
                $keyword = 'accounting';
            } elseif (Str::contains($titleLower, ['forex', 'trading', 'stock', 'saham', 'currency'])) {
                $keyword = 'trading';
            } elseif (Str::contains($titleLower, ['excel', 'sheets', 'spreadsheet', 'vba', 'macro'])) {
                $keyword = 'excel';
            } elseif (Str::contains($titleLower, ['powerpoint', 'word', 'office'])) {
                $keyword = 'office_tools';
            } elseif (Str::contains($titleLower, ['photoshop', 'illustrator', 'canva', 'figma'])) {
                $keyword = 'graphic_design';
            } elseif (Str::contains($titleLower, ['autocad', 'solidworks', 'cad'])) {
                $keyword = '3d_cad';
            } elseif (Str::contains($titleLower, ['guitar', 'gitar'])) {
                $keyword = 'guitar';
            } elseif (Str::contains($titleLower, ['piano', 'keyboard'])) {
                $keyword = 'piano';
            } elseif (Str::contains($titleLower, ['ukulele'])) {
                $keyword = 'ukulele';
            } elseif (Str::contains($titleLower, ['sing', 'vocal', 'voice'])) {
                $keyword = 'singing';
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

        if (Str::contains($titleLower, ['excel', 'word', 'powerpoint', 'vba', 'macro'])) {
            if (Str::contains($titleLower, ['powerpoint'])) {
                return $categories->firstWhere('name', 'PowerPoint')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['word'])) {
                return $categories->firstWhere('name', 'Microsoft Word')->id ?? $randomFallbackId;
            }
            return $categories->firstWhere('name', 'Excel Basic')->id ?? $randomFallbackId;
        }

        if (Str::contains($titleLower, ['cyber', 'security', 'hack', 'network', 'cisco', 'ccna', 'firewall'])) {
            if (Str::contains($titleLower, ['hack', 'penetration', 'ethical'])) {
                return $categories->firstWhere('name', 'Ethical Hacking')->id ?? $randomFallbackId;
            }
            return $categories->firstWhere('name', 'Cyber Security')->id ?? $randomFallbackId;
        }

        if (Str::contains($titleLower, ['time', 'productivity', 'procrastination', 'speak', 'present', 'interview', 'resume', 'career'])) {
            if (Str::contains($titleLower, ['time', 'productivity', 'procrastination'])) {
                return $categories->firstWhere('name', 'Time Management')->id ?? $randomFallbackId;
            }
            if (Str::contains($titleLower, ['speak', 'present', 'public'])) {
                return $categories->firstWhere('name', 'Public Speaking')->id ?? $randomFallbackId;
            }
            return $categories->firstWhere('name', 'Interview Skills')->id ?? $randomFallbackId;
        }

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
            'coding' => ['1587629197415-2ab68d7a52b7', '1498050108023-c5249f4df085', '1555066931-4365d14bab8c'],
            'cybersecurity' => ['1550751827-4bd374c3f58b', '1563986768609-322da13575f3'],
            'accounting' => ['1554224155-8d04cb21cd6c', '1454165804606-c3d57bc86b40'],
            'trading' => ['1590283603385-17ffb3a7f29f', '1611974789855-9c2a0a7236a3'],
            'excel' => ['1551288049-bebda4e38f71', '1460925895917-afdab827c52f'],
            'office_tools' => ['1586281380349-632531db7ed4', '1513151233558-d860c5398176'],
            'graphic_design' => ['1561070791-2526d30994b5', '1550684848-fac1c5b4e853'],
            '3d_cad' => ['1581092160607-ee22621dd758', '1504917595217-d4dc5ebe6122'],
            'guitar' => ['1510915361894-db8b60106cb1', '1511671782779-c97d3d27a1d4'],
            'piano' => ['1520523839897-bd0b52f945a0', '1552422535-c45813c61732'],
            'ukulele' => ['1508186225823-0963cf9ab0de'],
            'singing' => ['1516280440614-37939bbacd6a', '1598387181032-a3103a2db5b5'],
            'public_speaking' => ['1524178232363-1fb2b075b655', '1475721027490-800d556019eb'],
            'time_management' => ['1508962914676-134849a727f0', '1506784983877-45594efa4cbe'],
            'career_prep' => ['1573497019940-1b28c7a6f7b4', '1434030216411-0b793f4b4173'],
            'general_education' => ['1427504494785-3a9ca7044f45', '1497633762265-2d179a990ab6']
        ];

        $list = $photos[$keyword] ?? $photos['general_education'];
        return $list[array_rand($list)];
    }
}