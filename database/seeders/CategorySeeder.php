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
    'Pengembangan' => [
        'Pengembangan Web' => ['JavaScript', 'React JS', 'Angular', 'TypeScript', 'ASP.NET Core', 'Next.js', 'Kecerdasan Buatan (AI)', 'Node.js'],
        'Ilmu Data' => ['AI Agents & Agentic AI', 'AI', 'Model Bahasa Besar', 'Pembelajaran Mesin', 'Generative AI (GenAI)', 'Python', 'LangChain', 'Pembelajaran Mendalam'],
        'Pengembangan Seluler' => ['Google Flutter', 'React Native', 'Dart', 'Pengembangan iOS', 'Pengembangan Android', 'Swift', 'SwiftUI', 'Pengembangan Aplikasi Seluler', 'Kotlin'],
        'Bahasa Pemrograman' => ['Python', 'Java', 'C# (Bahasa Pemrograman)', 'C++ (Programming Language)', 'React JS', 'Go (Bahasa Pemrograman)', 'C (Bahasa Pemrograman)', 'Rust', 'Spring Framework'],
        'Pengembangan Game' => ['Unreal Engine', 'Unity', 'Dasar-Dasar Pengembangan Game', 'Pengembangan Game 3D', 'C#', 'Godot', 'Pengembangan Game 2D', 'C++', 'Cetak Biru Unreal Engine'],
        'Desain Pengembangan Database' => ['SQL', 'MySQL', 'Sistem Manajemen Database (DBMS)', 'PostgreSQL', 'SQL Server', 'Apache Kafka', 'Oracle SQL', 'PL/SQL', 'MongoDB'],
        'Pengujian Perangkat Lunak' => ['Microsoft Playwright', 'AI Agents dan Agentic AI', 'ISTQB Certified Tester Foundation Level', 'Selenium WebDriver', 'Pengujian Otomatisasi', 'Postman', 'AI', 'Java'],
        'Rekayasa Perangkat Lunak' => ['AI Agents dan Agentic AI', 'Spring Framework', 'Arsitektur Perangkat Lunak', 'Struktur Data', 'CKAD', 'Algoritme', 'Layanan Mikro', 'Wawancara Coding', 'Spring AI'],
        'Alat Pengembangan Perangkat Lunak' => ['Claude Code', 'Rekayasa Prompt', 'Docker', 'GitHub Copilot', 'Git', 'Kubernetes', 'OpenAI Codex', 'GitHub', 'CI/CD'],
        'Pengembangan Tanpa Kode' => ['n8n', 'AI Agents dan Agentic AI', 'Vibe Coding', 'Microsoft Copilot', 'WordPress', 'Microsoft Power Apps', 'Microsoft Power Platform', 'Microsoft Power Automate', 'Produktivitas Kantor'],
    ],
    'Bisnis' => [
        'Kewirausahaan' => ['Kecerdasan Buatan (AI)', 'Pengiriman Truk', 'Dasar-Dasar Bisnis', 'Dasar-Dasar Kewirausahaan', 'Model Bahasa Besar (LLM)', 'Bisnis Online', 'Bekerja Lepas', 'Strategi Bisnis', 'ChatGPT'],
        'Komunikasi' => ['Keahlian Komunikasi', 'Berbicara di Depan Umum', 'Keahlian Presentasi', 'Komunikasi Bisnis', 'Menulis', 'Menulis Fiksi', 'Bercerita', 'Layanan Pelanggan', 'Ketegasan'],
        'Manajemen' => ['PMI Project Management Professional (PMP)', 'PMI PMBOK', 'Manajemen Produk', 'Keahlian Manajemen', 'Kepemimpinan', 'Strategi Bisnis', 'Kecerdasan Buatan (AI)', 'ISO 9001', 'Diploma Level 4 CIPS'],
        'Penjualan' => ['Keahlian Penjualan', 'Penjualan B2B', 'Manajemen Penjualan', 'Layanan Pelanggan', 'LinkedIn', 'Telepon Buta', 'CRM', 'Pembuatan Prospek', 'CSM'],
        'Strategi Bisnis' => ['Kecerdasan Buatan (AI)', 'Konsultasi Manajemen', 'Bisnis Online', 'ChatGPT', 'Diploma Professional Level 6 CIPS', 'Environmental Social and Governance (ESG)', 'TOGAF Enterprise Architecture', 'TOGAF'],
        'Operasi' => ['Sertifikasi Lean Six Sigma Green Belt', 'Rantai Pasokan', 'n8n', 'Manajemen Kualitas', 'Manajemen Logistik', 'Manajemen Operasi', 'Certified Quality Engineer (CQE)', 'Sertifikat Lean Six Sigma Black Belt', 'Skill Asisten Virtual'],
        'Manajemen Proyek' => ['PMI Project Management Professional (PMP)', 'PMI CAPM', 'PMI PMBOK', 'Scrum', 'Agile', 'Analisis Bisnis', 'PRINCE2', 'Kecerdasan Buatan (AI)'],
        'Hukum Bisnis' => ['GDPR', 'Certified Information Professional (CIPP)', 'Hukum', 'Undang-Undang Kecerdasan Buatan UE', 'Manajemen Kepatuhan', 'Hukum Kontrak', 'HIPAA', 'Riset Hukum'],
        'Analisis dan Kecerdasan Buatan' => ['Microsoft Power BI', 'SQL', 'Pemodelan Data', 'Analis Data', 'Analisis Bisnis', 'Claude AI', 'Tableau Microsoft Copilot', 'Ilmu Data'],
        'Sumber Daya Manusia' => ['Merekrut dan Memperkerjakan', 'Analitik SDM', 'Professional in Human Resources (PHR)', 'L&D Korporat', 'Akuntansi Pembayaran', 'Hukum Ketenagakerjaan', 'SHRM-SCP', 'SHRM-CP'],
        'Industri' => ['Piping', 'AI Generatif (GenAI)', 'Kecerdasan Buatan (AI)', 'Ahli Kunci', 'Industri Minyak dan Gas', 'Teknik Kontrol', 'Bisnis Perjalanan', 'Kesehatan dan Keselamatan Kerja', 'GMP'],
        'E-Commerce' => ['Amazon FBA', 'Dropshipping', 'Shopify', 'Shopify Dropshipping', 'Etsy', 'Menjual di Amazon', 'Mercado Libre', 'Bisnis Online'],
        'Media' => ['AI Generatif (GenAI)', 'Suno AI', 'ComfyUI', 'Menulis Kreatif', 'Pengembangan Karier', 'Canva', 'Buku Audio', 'Pembuatan Video', 'Midjourney'],
        'Real Estate' => ['Investasi Real Estate', 'Hipotek', 'Pemodelan Keuangan', 'Hosting Airbnb', 'Renovasi Real Estate', 'Pemasaran Real Estate', 'Manajemen Properti'],
        'Bisnis Lainnya' => ['Kecerdasan Buatan (AI)', 'QuickBooks', 'GoHighLevel', 'AI Generatif (GenAI)', 'Skill Entri Data', 'Penulisan Hibah', 'ChatGPT', 'Notion Workspace'],
    ],
    'Keuangan dan Akuntansi' => [
        'Akuntansi dan Laporan Keuangan' => ['Akuntansi', 'Pembukuan', 'QuickBooks', 'Akuntansi Keuangan', 'TallyPrime (Tally.ERP)', 'Xero', 'Akuntansi Pembayaran', 'IFRS', 'Dasar-Dasar Keuangan'],
        'Kepatuhan' => ['Anti Pencucian Uang (AML)', 'Kriminologi', 'Environmental Social and Governance', 'Analitik Penipuan', 'Manajemen Kepatuhan', 'Certified Anti-Money Laundering Specialist', 'Kontrol Internal', 'ERM', 'Sarbanes-Oxley'],
        'Cryptocurrency & Blockchain' => ['Cryptocurrency', 'Blockchain', 'Bitcoin', 'Binance', 'Perdagangan Harian', 'Analisis Teknis', 'Decentralized Finance', 'Perdagangan Bitcoin', 'Kriptografi'],
        'Ekonomi' => ['Makroekonomi', 'Mikroekonomi', 'Ekonomi Global', 'Dasar-Dasar Keuangan', 'Ekonomi Perilaku', 'Stata', 'Laporan Keuangan', 'Real Estate'],
        'Keuangan' => ['Keuangan Pribadi', 'Dasar-Dasar Keuangan', 'Perbankan Investasi', 'Perbankan', 'Analisis Keuangan', 'Keuangan Perusahaan', 'Big Data', 'Manajemen Keuangan', 'CFA'],
        'Sertifikasi dan Persiapan Ujian' => ['Chartered Financial Analyst', 'Auditor Internal Bersertifikasi', 'FINRA Securities Industry Essentials', 'Certified Management Accountant', 'Dasar-Dasar Keuangan', 'ACCA', 'Sertifikasi ANBIMA', 'Certified Fraud Examiner'],
        'Pemodelan dan Analisis Keuangan' => ['Analisis Keuangan', 'Pemodelan Keuangan', 'Microsoft Excel', 'Perbankan Investasi', 'Python', 'Dasar-Dasar Keuangan', 'Akuntansi', 'Akuntansi Keuangan', 'Perencanaan Keuangan'],
        'Investasi dan Perdagangan' => ['Perdagangan Saham', 'Investasi', 'Jual-Beli Forex', 'Perdagangan Harian', 'Analisis Teknis', 'Perdagangan Algoritmis', 'Perdagangan Opsi', 'Pasar Keuangan', 'Perdagangan Keuangan'],
        'Alat Manajemen Keuangan' => ['QuickBooks', 'SAP FICO', 'Microsoft Excel', 'Xero', 'Keuangan Pribadi', 'Pemodelan Keuangan', 'Analisis Keuangan', 'Analitik Excel', 'Sage Accounting'],
        'Pajak' => ['Pengaturan Pajak', 'Akuntansi', 'Pajak Pertambahan Nilai', 'Pajak Barang dan Jasa', 'Harga Transfer', 'Keuangan Perusahaan', 'Sistem Kontrol', 'Akuntansi Keuangan'],
    ],
    'TI & Perangkat Lunak' => [
        'Sertifikasi TI' => ['AWS Solutions Architect', 'CompTIA Security+', 'AWS Cloud Practitioner', 'CompTIA A+', 'Cisco CCNA', 'CompTIA Network+', 'Amazon AWS', 'Keamanan Informasi', 'AWS AI Practitioner'],
        'Jaringan dan Keamanan' => ['Ethical Hacking', 'Keamanan Cyber', 'Keamanan Jaringan', 'Dasar Jaringan TI', 'Kubernetes', 'Fortigate', 'Uji Penetrasi', 'OSINT', 'CompTIA Security+'],
        'Perangkat Keras' => ['PLC', 'Sistem Tertanam', 'Elektronika', 'Arduino', 'Mikrokontroler', 'Embedded C', 'KiCad', 'Desain PCB', 'Perangkat Keras Komputer'],
        'Sistem Operasi dan Server' => ['Linux', 'Administrasi Linux', 'Windows Server', 'Administrasi Sistem', 'Proxmox VE', 'PowerShell', 'Active Directory', 'Shell Scripting', 'SQL'],
        'TI & Perangkat Lunak Lainnya' => ['DevOps', 'AI Agents & Agentic AI', 'Kecerdasan Buatan', 'Python', 'AI Generatif', 'Claude Code', 'ChatGPT', 'n8n', 'Microsoft Excel'],
    ],
    'Produktivitas Kantor' => [
        'Materi Microsoft' => ['Microsoft Excel', 'Microsoft Power BI', 'Microsoft 365', 'Microsoft Copilot', 'PowerPoint', 'Formula dan Fungsi Excel', 'Excel VBA', 'Microsoft Project', 'Microsoft SharePoint'],
        'Apple' => ['Dasar-Dasar Mac', 'iMovie', 'macOS', 'Apple Keynote', 'Dasar-Dasar Produk Apple', 'Numbers for Mac', 'Pages for Mac', 'Microsoft 365', 'Microsoft Excel'],
        'Google' => ['Google Spreadsheet', 'Google Workspace (G Suite)', 'Google NotebookLM', 'Google Gemini (Bard)', 'Google Looker Studio', 'Google Drive', 'Google AppSheet'],
        'SAP' => ['SAP S/4HANA', 'SAP MM', 'SAP ABAP', 'SAP BTP', 'SAP FICO', 'SAP SD', 'SAP HCM', 'SAP Business One'],
        'Oracle' => ['Oracle Primavera', 'Oracle Fusion HCM', 'Oracle SQL', 'PL/SQL', 'Manajemen Proyek', 'Oracle ERP', 'Oracle Database', 'Administrasi Database', 'Oracle Data Integrator'],
        'Lainnya' => ['ChatGPT', 'Claude AI', 'Kecerdasan Buatan (AI)', 'Microsoft Power BI', 'Notion Workspace', 'Google Gemini', 'AI Generatif', 'n8n', 'Microsoft Copilot'],
    ],
    'Pengembangan Personal' => [
        'Transformasi Pribadi' => ['Life Coaching', 'Pengembangan Pribadi', 'NLP', 'Terapi Suara', 'Public Speaking', 'Filsafat', 'Bimbingan', 'Kecerdasan Emosional'],
        'Produktivitas Pribadi' => ['AI Generatif', 'ChatGPT', 'Manajemen Waktu', 'Kecerdasan Buatan', 'Obsidian', 'Notion', 'AI Agents & Agentic AI', 'Membaca Cepat'],
        'Kepemimpinan' => ['Keahlian Manajemen', 'Pelatihan Manajer', 'Bimbingan', 'Keahlian Komunikasi', 'Manajemen Konflik', 'Filsafat', 'ISACA Advanced in AI Audit', 'Public Speaking'],
        'Pengembangan Karier' => ['Keahlian Wawancara', 'Konstruksi', 'Komunikasi Bisnis', 'Pengkodean Medis', 'Penulisan Bisnis', 'Pemeriksaan Bangunan', 'Perbaikan Mobil', 'Dukungan TI/Teknis'],
        'Pengasuhan & Hubungan' => ['Pengasuhan Anak', 'Membangun Hubungan', 'Psikologi Anak', 'Konseling Pasangan', 'Autisme', 'P3K', 'Pernikahan', 'Cinta', 'Kencan'],
        'Kebahagiaan' => ['Life Coaching', 'Manifestasi & Law of Attraction', 'Psikologi', 'Kesadaran Mental', 'CBT', 'Meditasi', 'Psikologi Positif', 'NLP'],
        'Praktik Eksoterik' => ['Reiki', 'Membaca Tarot', 'Penyembuhan Energi', 'Inspirasi Spiritual', 'Paranormal', 'Hipnoterapi', 'Astrologi', 'Penyembuhan Spiritual', 'Catatan Akhasik'],
        'Agama & Spiritualitas' => ['Spiritualitas', 'Membaca Tarot', 'Penyembuhan Energi', 'Reiki', 'Penyembuhan Spiritual', 'Kekristenan', 'Life Coaching', 'Alkitab', 'Numerologi'],
        'Membangun Citra Pribadi' => ['Rapat', 'Citra Pribadi', 'Obsidian', 'LinkedIn', 'Keahlian Presentasi', 'Pengembangan Karier', 'Pemasaran Influencer', 'Keahlian Komunikasi'],
        'Kreativitas' => ['Menulis Kreatif', 'Penulisan Skenario', 'Menulis Buku', 'Menulis', 'Menulis Fiksi', 'Bercerita', 'Teori Warna', 'Menulis Novel', 'Terapi Seni'],
        'Pengaruh' => ['Pelatihan Suara', 'Keahlian Komunikasi', 'Public Speaking', 'Persuasi', 'Negosiasi', 'Bahasa Tubuh', 'Keahlian Mempengaruhi', 'Skill Sosial', 'Psikologi'],
        'Kepercayaan Diri' => ['Kepercayaan Diri', 'Harga Diri', 'Keahlian Komunikasi', 'Psikoterapi', 'Pengembangan Pribadi', 'Bimbingan', 'Public Speaking', 'Penerimaan Diri', 'Menari'],
        'Pengelolaan Stres' => ['Manajemen Kecemasan', 'Kecerdasan Emosional', 'Bimbingan', 'Pengelolaan Amarah', 'Ketangguhan', 'Penyembuhan Duka', 'Kesadaran Mental', 'Terapi Suara'],
        'Memori & Belajar' => ['Memori', 'Membaca Cepat', 'Strategi Belajar', 'Keahlian Belajar', 'Penguasaan Fokus', 'Obsidian', 'Pemetaan Pikiran', 'Pengembangan Pribadi', 'Berpikir Kritis'],
        'Motivasi' => ['Neuroplastisitas', 'Tata Bahasa Inggris', 'NLP', 'Bahasa Inggris', 'Bimbingan', 'Ilmu Saraf', 'Filsafat', 'Menghadapi Hubungan Toksik'],
    ],
    'Desain' => [
        'Desain Web' => ['WordPress', 'Figma', 'Desain Aplikasi', 'CSS', 'Pengembangan Web', 'UI Design', 'Webflow', 'Elementor'],
        'Desain Grafis & Ilustrasi' => ['Desain Grafis', 'Menggambar', 'Adobe Illustrator', 'Adobe Photoshop', 'Canva', 'Procreate', 'Adobe InDesign', 'Lukisan Digital', 'Desain Karakter'],
        'Alat Desain' => ['AutoCAD', 'SOLIDWORKS', 'Canva', 'Figma', 'Rhino 3D', 'Procreate', 'Desain Grafis', 'Adobe After Effects', 'AI Generatif'],
        'Desain UI/UX' => ['Desain Pengalaman Pengguna (UX)', 'Figma', 'Desain Aplikasi Seluler', 'Desain Produk', 'UX Writing', 'UI Design', 'Aksesibilitas Web', 'Design Thinking', 'Desain Web'],
        'Desain Game' => ['Seni Piksel', 'Unreal Engine', 'Blender', 'Unity', 'Texturing Game', 'VFX', 'Lukisan Digital', 'Desain Level'],
        '3D & Animasi' => ['Blender', 'Pemodelan 3D', 'Autodesk Fusion', 'Adobe After Effects', 'Pencetakan 3D', 'Motion Graphics', 'Animasi 3D', 'Pemahatan 3D', 'Unreal Engine'],
        'Desain Arsitektur' => ['Revit', 'AutoCAD', 'BIM', 'LEED', 'SketchUp', 'Pemodelan 3D', 'ARCHICAD', 'Rhino 3D'],
    ],
    'Pemasaran' => [
        'Pemasaran Digital' => ['Pemasaran Media Sosial', 'Strategi Pemasaran', 'Pemasaran Internet', 'ChatGPT', 'Iklan Facebook', 'Google Analytics', 'Animasi 3D', 'Saluran Penjualan'],
        'Optimasi Mesin Pencari' => ['SEO', 'WordPress', 'Riset Kata Kunci', 'Pemasaran Digital', 'Google Bisnisku', 'SEO Lokal', 'Audit SEO', 'Membangun Tautan', 'ChatGPT'],
        'Pemasaran Media Sosial' => ['Manajemen Media Sosial', 'Pemasaran Instagram', 'Pemasaran Facebook', 'Iklan Facebook', 'Canva', 'Pemasaran YouTube', 'Pemasaran TikTok', 'Konten AI'],
        'Branding' => ['YouTube Growth', 'Pemasaran YouTube', 'Manajemen Citra Bisnis', 'Manajemen Merek', 'Citra Pribadi', 'LinkedIn', 'Merchandising', 'Strategi Pemasaran'],
        'Dasar-Dasar Pemasaran' => ['Strategi Pemasaran', 'Copywriting', 'Psikologi Pemasaran', 'Psikologi', 'Perencanaan Acara', 'Pemasaran Digital', 'MBA'],
        'Analitik & Otomatisasi' => ['Google Analytics', 'HubSpot', 'AI Agents & Agentic AI', 'Analitik Pemasaran', 'Google Tag Manager', 'Otomatisasi Pemasaran', 'Google Gemini', 'Pemasaran Digital', 'Marketo'],
        'Iklan Berbayar' => ['Google Ads', 'Sertifikasi Google Ads', 'Iklan Facebook', 'Periklanan PPC', 'Strategi Periklanan', 'Lalu Lintas Web', 'LinkedIn', 'Copywriting'],
    ],
    'Gaya Hidup' => [
        'Seni & Kerajinan' => ['Menggambar', 'Cat Air', 'Sketsa', 'Cat Akrilik', 'Menggambar Tokoh', 'Melukis', 'Lilin', 'Pensil', 'Cat Minyak'],
        'Kecantikan & Makeup' => ['Seni Makeup', 'Perawatan Kulit', 'Nail Artistry', 'Kecantikan', 'Parfum', 'Bisnis Kecantikan', 'Menata Rambut', 'Kosmetik', 'Facelift'],
        'Makanan & Minuman' => ['Memasak', 'Kopi', 'Wine Tasting', 'Baking', 'Koktail & Bartending', 'Sourdough', 'Membuat Roti', 'Oven Baking', 'CakePHP'],
        'Gaming' => ['Catur', 'Poker', 'eSports', 'Open Broadcaster', 'League of Legends', 'Trik Sulap', 'Desain Karakter'],
        'Perjalanan' => ['Kiat Perjalanan', 'Bisnis Perjalanan', 'Bahasa Portugis', 'Menulis Perjalanan', 'Hosting Airbnb', 'Digital Nomad'],
    ],
    'Musik' => [
        'Instrumen' => ['Gitar', 'Piano', 'Keyboard', 'Gitar Bas', 'Drum', 'Akor Piano', 'Viola', 'Harmonika', 'Ukulele'],
        'Produksi Musik' => ['Ableton Live', 'Logic Pro', 'FL Studio', 'Mixing Music', 'Desain Suara', 'Komposisi Musik', 'Teknik Audio', 'Beat'],
        'Dasar-Dasar Musik' => ['Teori Musik', 'Komposisi Musik', 'Musik Elektronik', 'Menciptakan Lagu', 'Membaca Musik', 'Pelatihan Telinga', 'Harmoni ABRSM', 'Piano'],
        'Vokal' => ['Menyanyi', 'Pelatihan Suara', 'Kepercayaan Diri', 'Akting Suara', 'Musik Raga', 'Musik Rap', 'Meditasi', 'Yoga'],
    ],
    'Pengajaran & Akademis' => [
        'Teknik' => ['Sirkuit Listrik', 'Teknik Listrik', 'Elektronika', 'Teknik Mesin', 'Kelistrikan', 'Teknik Sipil', 'Teknik Otomotif', 'Energi Surya', 'Rekayasa Daya'],
        'Matematika' => ['Kalkulus', 'Statistika', 'Aljabar Linear', 'Aljabar', 'LLM', 'Matematika Diskret', 'Probabilitas', 'Trigonometri'],
        'Sains' => ['Fisika', 'Riset Kimia', 'Kimia', 'Pengkodean Medis', 'Industri Farmasi', 'Anatomi', 'CPC', 'Farmakovigilans', 'Biologi'],
        'Pembelajaran Bahasa' => ['Bahasa Inggris', 'Bahasa Jerman', 'Bahasa Prancis', 'Bahasa Spanyol', 'Tata Bahasa Inggris', 'Bahasa Jepang', 'Bahasa Mandarin', 'Bahasa Italia'],
    ],
];

        foreach ($data as $mainName => $subCategories) {
    $main = Category::updateOrCreate(
        ['slug' => Str::slug($mainName)],
        ['name' => $mainName]
    );

    foreach ($subCategories as $subName => $topics) {
        // Buat slug sub-kategori unik (induk-sub)
        $subSlug = Str::slug($mainName . '-' . $subName);
        
        $sub = Category::updateOrCreate(
            ['slug' => $subSlug],
            ['name' => $subName, 'parent_id' => $main->id]
        );

        foreach ($topics as $topicName) {
            // Buat slug topik unik (sub-topik) agar tidak bentrok dengan kategori lain
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
