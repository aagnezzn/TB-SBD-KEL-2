<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FAQ;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FAQ::create([
        'question' => 'Apa itu Paket Personal?',
        'answer' => 'Paket Personal adalah langganan bulanan yang memberikan Anda akses ke pilihan 28.000 kursus teratas yang telah dikurasi. Koleksi ini menampilkan kursus-kursus mengenai topik-topik profesional yang diminati — termasuk pengembangan web, sertifikasi TI, ilmu data, desain web, pemasaran digital, dan kepemimpinan — bersama dengan pilihan topik pengembangan diri, seperti pembelajaran bahasa, seni dan kreativitas, dan keuangan pribadi..',
        ]);

        FAQ::create([
        'question' => 'Apa beda Paket Personal dengan membeli kursus?',
        'answer' => 'Dengan Paket Personal, Anda mendapat akses bulanan ke lebih dari 28.000 kursus berperingkat teratas dan aktivitas praktik dalam kategori teknologi, bisnis, dan pribadi terpopuler. Saat membeli satu kursus Idemy, Anda mendapat akses seumur hidup hanya ke kursus tersebut dan materi kursusnya.',
        ]);

        FAQ::create([
        'question' => 'Bagaimana kursus dipilih untuk Paket Personal?',
        'answer' => 'Lebih dari 28.000 kursus yang disertakan dalam Paket Personal dikurasi oleh para ahli konten Idemy dari katalog 250.000 kursus kami. Kami menggunakan wawasan dari 75.000 pembelajar di seluruh dunia untuk mengidentifikasi kursus berperingkat teratas yang relevan dalam topik profesional yang paling diminati serta pilihan topik pengembangan diri. Paket Personal memberi Anda akses mudah ke kursus terbaru berkualitas tinggi yang mengajarkan berbagai skill terbaru.',
        ]);

        FAQ::create([
        'question' => 'Bagaimana dan kapan saya akan dikenakan biaya?',
        'answer' => 'Jika langganan Anda dimulai dengan penawaran uji coba gratis, Anda akan dikenakan biaya berlangganan untuk siklus tagihan pertama di akhir uji coba Anda. Jika Anda mendaftar ke langganan berbayar, biaya berlangganan untuk siklus tagihan pertama Anda akan segera dikenakan setelah mendaftar ke Paket Personal. Anda akan ditagih biaya berlangganan serta pajak transaksi yang berlaku pada hari yang sama setiap tahunnya. Anda dapat melihat tanggal penagihan Anda di halaman Berlangganan.',
        ]);

        FAQ::create([
        'question' => 'Bagaimana cara saya membatalkan langganan saya?',
        'answer' => 'Jika Anda merasa langganan kurang pas untuk Anda, Anda dapat mengelola atau membatalkan uji coba atau langganan Anda kapan saja.',
        ]);

        FAQ::create([
        'question' => 'Apakah semua kursus Idemy tercakup dalam Paket Personal?',
        'answer' => 'Tidak. 28.000 kursus dalam paket personal adalah kursus berperingkat tertinggi kami dalam topik teknologi, bisnis, dan pengembangan diri, serta telah dikurasi khusus untuk membantu Anda memajukan karier. Anda dapat mengakses semua kursus yang paling banyak diminati dalam Paket Personal ketika berlangganan, dan tetap membeli kursus di luar langganan kapan pun.',
        ]);
    }
}
