<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('data/all_courses.csv');

        // Validasi keberadaan file
        if (!file_exists($file)) {
            echo "Kesalahan Eksekusi: File CSV tidak ditemukan di database/data/all_courses.csv\n";
            return;
        }

        $open = fopen($file, "r");
        
        // Lewati Header. Perhatikan parameter ketiga sekarang adalah ";"
        $header = fgetcsv($open, 2000, ";"); 

        // Mengambil ID Kategori dan Instruktur sebagai rujukan Foreign Key
        $categoryIds = Category::whereNotNull('parent_id')->pluck('id')->toArray();
        $instructorIds = User::where('role', 'instructor')->pluck('id')->toArray();

        // Pencegahan kegagalan integritas jika tabel referensi kosong
        if (empty($categoryIds) || empty($instructorIds)) {
            echo "Integritas Gagal: Tabel categories atau users (instructor) kosong. Pastikan urutan di DatabaseSeeder benar.\n";
            return;
        }

        // Iterasi ekstraksi data menggunakan pemisah ";"
        while (($data = fgetcsv($open, 2000, ";")) !== FALSE) {
            
            // KONVERSI ENCODING MUTLAK (Pembersihan Data Kotor)
            // Mengubah karakter ANSI menjadi UTF-8 agar MySQL tidak menolak data
            $title = mb_convert_encoding($data[1], 'UTF-8', 'ISO-8859-1');
            $subject = mb_convert_encoding($data[10], 'UTF-8', 'ISO-8859-1');
            $level = mb_convert_encoding($data[7], 'UTF-8', 'ISO-8859-1');

            // Logika Transformasi Data Harga
            $rawPrice = $data[3];
            if (strtolower(trim($rawPrice)) === 'free') {
                $priceInRupiah = 0;
            } else {
                // Menghilangkan tanda '$', koma ',00', dan titik '.' agar tersisa angka murni
                $cleanPrice = str_replace(['$', ',00', '.'], '', $rawPrice);
                $priceInRupiah = (int) $cleanPrice * 15000; // Konversi ke Rupiah
            }

            // Injeksi data ke Database
            Course::create([
                'title' => $title, 
                'description' => 'Materi komprehensif mengenai ' . $subject . ' yang dirancang khusus untuk tingkat ' . $level . '.',
                'price' => $priceInRupiah,
                'image_url' => 'https://loremflickr.com/320/180/education?random=' . rand(1, 1000),
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'instructor_id' => $instructorIds[array_rand($instructorIds)],
            ]);
        }

        fclose($open);
    }
}