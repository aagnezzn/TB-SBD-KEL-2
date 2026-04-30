@extends('layouts.app')
@section('content') 
    <div class="relative bg-[#e5e7eb] overflow-hidden">
        <div class="max-w-[1340px] mx-auto px-6 lg:px-10 flex flex-col md:flex-row items-center min-h-[450px]">
            
            <!-- Sisi Kiri: Teks -->
            <div class="w-full md:w-1/2 py-12 md:py-0 z-10">
                <h1 class="text-[40px] md:text-[52px] font-bold text-[#2d2f31] leading-tight font-serif">
                    Mengajarlah <br> bersama kami
                </h1>
                <p class="mt-4 text-lg text-[#2d2f31] max-w-sm">
                    Jadilah instruktur dan ubah hidup — termasuk hidup Anda sendiri
                </p>
                
                <a href="/#" 
                   class="inline-block mt-8 rounded-xl border bg-purple-800 text-white px-16 py-2 font-bold hover:bg-purple-600 transition shadow-sm text-center min-w-[350px]">
                    Memulai
                </a>
            </div>

            <!-- Sisi Kanan: Gambar -->
            <div class="w-full md:w-1/2 relative flex justify-end items-end h-full">
                <img src="{{ asset('mengejar.png') }}" 
                     alt="Instruktur Idemy" 
                     class="w-full h-auto max-h-[500px] object-cover object-top">
            </div>
        </div>
    </div>
    
    <!-- Lanjutkan ke section berikutnya... -->
    
<div class="max-w-[1340px] mx-auto pt-10 pb-12 px-6 lg:px-10">
    <h2 class="text-[28px] md:text-[36px] font-bold text-center text-[#2d2f31] mb-8 font-serif tracking-tight leading-tight">
        Begitu banyak alasan untuk memulai
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 justify-center text-center max-w-[1100px] mx-auto">
        <div class="flex flex-col items-center">
            <div class="h-[80px] flex items-center justify-center mb-4">
                <img src="{{ asset('ajari.png') }}" class="w-24 h-24 object-contain">
            </div>
            <h3 class="text-[15px] font-bold mb-2 text-[#2d2f31]">Ajari Jalan Anda</h3>
            <p class="text-[#2d2f31] text-[13px] leading-relaxed max-w-[220px] opacity-90">
                Publikasikan kursus yang Anda inginkan, dengan cara yang Anda inginkan, dan selalu kontrol konten Anda sendiri.
            </p>
        </div>

        <div class="flex flex-col items-center">
            <div class="h-[80px] flex items-center justify-center mb-4">
                <img src="{{ asset('inspirasi.png') }}" class="w-24 h-24 object-contain">
            </div>
            <h3 class="text-[15px] font-bold mb-2 text-[#2d2f31]">Inspirasi orang yang ingin belajar</h3>
            <p class="text-[#2d2f31] text-[13px] leading-relaxed max-w-[220px] opacity-90">
                Ajarkan yang Anda ketahui dan bantu orang yang ingin belajar menjelajahi minat mereka, mendapatkan skill baru.
            </p>
        </div>

        <div class="flex flex-col items-center">
            <div class="h-[80px] flex items-center justify-center mb-4">
                <img src="{{ asset('hadiah.png') }}" class="w-24 h-24 object-contain">
            </div>
            <h3 class="text-[15px] font-bold mb-2 text-[#2d2f31]">Dapatkan hadiah</h3>
            <p class="text-[#2d2f31] text-[13px] leading-relaxed max-w-[220px] opacity-90">
                Perluas jaringan profesional Anda, bangun keahlian Anda, dan dapatkan uang untuk setiap pendaftaran berbayar.
            </p>
        </div>
    </div>
</div>


<!--Teks kotak ungu -->
<section class="w-full bg-[#5624d0] py-16">
    <!-- Container untuk membatasi lebar maksimal konten di tengah -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Pembagian Grid: 2 kolom di HP, 5 kolom di PC/Laptop -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-8 text-center text-white">
            
            <!-- Item 1 -->
            <div class="flex flex-col items-center justify-center">
                <h3 class="text-4xl md:text-5xl font-bold mb-2">80 Jt</h3>
                <p class="text-sm md:text-base font-medium">Peserta</p>
            </div>

            <!-- Item 2 -->
            <div class="flex flex-col items-center justify-center">
                <h3 class="text-4xl md:text-5xl font-bold mb-2">75+</h3>
                <p class="text-sm md:text-base font-medium">Bahasa</p>
            </div>

            <!-- Item 3 -->
            <div class="flex flex-col items-center justify-center">
                <h3 class="text-4xl md:text-5xl font-bold mb-2">1,1 M</h3>
                <p class="text-sm md:text-base font-medium">Pendaftaran</p>
            </div>

            <!-- Item 4 -->
            <div class="flex flex-col items-center justify-center">
                <h3 class="text-4xl md:text-5xl font-bold mb-2">180+</h3>
                <p class="text-sm md:text-base font-medium">Negara</p>
            </div>

            <!-- Item 5 -->
            <div class="flex flex-col items-center justify-center col-span-2 md:col-span-1">
                <h3 class="text-4xl md:text-5xl font-bold mb-2">17.200+</h3>
                <p class="text-sm md:text-base font-medium">Pelanggan Enterprise</p>
            </div>

        </div>
    </div>
</section>

<!--Section Cara Anda Memulai-->
<section class="max-w-7xl mx-auto px-4 py-16">
    <!-- Judul Utama -->
    <h2 class="text-4xl font-bold text-center text-[#2d2f31] mb-12">Cara memulai</h2>

    <!-- Bagian Tombol Tab -->
    <div class="flex flex-wrap justify-center gap-x-8 border-b border-gray-300 mb-12">
        <button id="tab-btn-1" onclick="changeTab(1)" class="tab-btn pb-4 text-xl font-bold text-[#2d2f31] border-b-4 border-[#2d2f31] transition-all">Rencanakan kurikulum Anda</button>
        <button id="tab-btn-2" onclick="changeTab(2)" class="tab-btn pb-4 text-xl font-bold text-gray-500 border-b-4 border-transparent hover:text-[#2d2f31] transition-all">Rekam video Anda</button>
        <button id="tab-btn-3" onclick="changeTab(3)" class="tab-btn pb-4 text-xl font-bold text-gray-500 border-b-4 border-transparent hover:text-[#2d2f31] transition-all">Luncurkan kursus Anda</button>
    </div>

    <!-- Wadah Utama Konten -->
    <div class="relative">
        
        <!-- =========================== TAB 1 =========================== -->
        <div id="tab-content-1" class="tab-content block animate-fade-in">
            <!-- Pakai justify-center biar mereka kumpul di tengah, gap buat ngatur jaraknya -->
            <div class="flex flex-col-reverse md:flex-row items-center justify-center gap-x-12 lg:gap-x-24">
                
                <!-- Sisi Kiri: Teks -->
                <div class="w-full md:w-5/12 lg:w-4/12">
                    <p class="text-gray-700 text-[17px] leading-relaxed mb-4">Anda memulai dengan semangat dan pengetahuan. Kemudian pilihlah topik menjanjikan dengan bantu alat Wawasan Pasar kami.</p>
                    <p class="text-gray-700 text-[17px] leading-relaxed mb-6">Cara Anda mengajar — apa yang Anda bawa saat mengajar — terserah Anda.</p>
                    <h3 class="font-bold text-xl text-[#2d2f31] mb-2">Cara kami membantu Anda</h3>
                    <p class="text-gray-700 text-[17px] leading-relaxed">Kami menawarkan banyak sumber daya untuk cara membuat kursus pertama. Selain itu, dasbor instruktur dan halaman kurikulum kami akan membantu Anda menyusun rencana.</p>
                </div>

                <!-- Sisi Kanan: Gambar -->
                <div class="w-full md:w-auto">
                    <img src="{{ asset('rencanakankurikulum.png') }}" alt="Ilustrasi Perencanaan" class="max-w-[350px] md:max-w-[400px] w-full object-contain drop-shadow-sm">
                </div>
            </div>
        </div>

        <!-- =========================== TAB 2 =========================== -->
        <div id="tab-content-2" class="tab-content hidden animate-fade-in">
            <div class="flex flex-col-reverse md:flex-row items-center justify-center gap-x-12 lg:gap-x-24">
                <div class="w-full md:w-5/12 lg:w-4/12">
                    <p class="text-gray-700 text-[17px] leading-relaxed mb-4">Gunakan alat dasar seperti smartphone atau kamera DSLR. Tambahkan mikrofon yang bagus dan Anda siap memulai.</p>
                    <p class="text-gray-700 text-[17px] leading-relaxed mb-6">Jika Anda tidak nyaman berada di depan kamera, cukup ambil gambar layar. Apa pun cara yang Anda pilih, kami merekomendasikan video berdurasi dua jam atau lebih untuk kursus berbayar.</p>
                    <h3 class="font-bold text-xl text-[#2d2f31] mb-2">Cara kami membantu Anda</h3>
                    <p class="text-gray-700 text-[17px] leading-relaxed">Tim dukungan kami tersedia untuk membantu Anda di sepanjang proses dan menyediakan masukan mengenai video tes.</p>
                </div>
                <div class="w-full md:w-auto">
                    <img src="{{ asset('rekamvideo.png') }}" alt="Ilustrasi Rekaman Video" class="max-w-[350px] md:max-w-[400px] w-full object-contain drop-shadow-sm">
                </div>
            </div>
        </div>

        <!-- =========================== TAB 3 =========================== -->
        <div id="tab-content-3" class="tab-content hidden animate-fade-in">
            <div class="flex flex-col-reverse md:flex-row items-center justify-center gap-x-12 lg:gap-x-24">
                <div class="w-full md:w-5/12 lg:w-4/12">
                    <p class="text-gray-700 text-[17px] leading-relaxed mb-4">Kumpulkan peringkat dan ulasan dengan mempromosikan kursus Anda melalui media sosial dan jaringan profesional Anda.</p>
                    <p class="text-gray-700 text-[17px] leading-relaxed mb-6">Kursus Anda akan dapat ditemukan di marketplace kami, tempat Anda mendapatkan penghasilan dari setiap pendaftaran berbayar.</p>
                    <h3 class="font-bold text-xl text-[#2d2f31] mb-2">Cara kami membantu Anda</h3>
                    <p class="text-gray-700 text-[17px] leading-relaxed">Alat kupon kustom kami memungkinkan Anda menawarkan insentif pendaftaran sekaligus mendorong lalu lintas promosi global ke kursus. Ada lebih banyak lagi peluang untuk kursus yang dipilih untuk Udemy Business.</p>
                </div>
                <div class="w-full md:w-auto">
                    <img src="{{ asset('lumcurkankursus.png') }}" alt="Ilustrasi Peluncuran" class="max-w-[350px] md:max-w-[400px] w-full object-contain drop-shadow-sm">
                </div>
            </div>
        </div>

    </div>
</section>
<script>
    function changeTab(tabIndex) {
        document.querySelectorAll('.tab-content').forEach(function(content) {
            content.classList.remove('block');
            content.classList.add('hidden');
        });
        document.getElementById('tab-content-' + tabIndex).classList.remove('hidden');
        document.getElementById('tab-content-' + tabIndex).classList.add('block');

        document.querySelectorAll('.tab-btn').forEach(function(btn) {
            btn.classList.remove('text-[#2d2f31]', 'border-[#2d2f31]');
            btn.classList.add('text-gray-500', 'border-transparent');
        });

        let activeBtn = document.getElementById('tab-btn-' + tabIndex);
        activeBtn.classList.remove('text-gray-500', 'border-transparent');
        activeBtn.classList.add('text-[#2d2f31]', 'border-[#2d2f31]');
    }
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.4s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    function changeTab(tabIndex) {
        document.querySelectorAll('.tab-content').forEach(function(content) {
            content.classList.remove('block');
            content.classList.add('hidden');
        });

        document.getElementById('tab-content-' + tabIndex).classList.remove('hidden');
        document.getElementById('tab-content-' + tabIndex).classList.add('block');

        document.querySelectorAll('.tab-btn').forEach(function(btn) {
            btn.classList.remove('text-[#2d2f31]', 'border-[#2d2f31]');
            btn.classList.add('text-gray-500', 'border-transparent');
        });

        let activeBtn = document.getElementById('tab-btn-' + tabIndex);
        activeBtn.classList.remove('text-gray-500', 'border-transparent');
        activeBtn.classList.add('text-[#2d2f31]', 'border-[#2d2f31]');
    }
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.4s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<script>
    function changeTab(tabIndex) {
        document.querySelectorAll('.tab-content').forEach(function(content) {
            content.classList.remove('block');
            content.classList.add('hidden');
        });

        document.getElementById('tab-content-' + tabIndex).classList.remove('hidden');
        document.getElementById('tab-content-' + tabIndex).classList.add('block');

        document.querySelectorAll('.tab-btn').forEach(function(btn) {
            btn.classList.remove('text-[#2d2f31]', 'border-[#2d2f31]');
            btn.classList.add('text-gray-500', 'border-transparent');
        });

        let activeBtn = document.getElementById('tab-btn-' + tabIndex);
        activeBtn.classList.remove('text-gray-500', 'border-transparent');
        activeBtn.classList.add('text-[#2d2f31]', 'border-[#2d2f31]');
    }
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.4s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- Script JavaScript -->
<script>
    function changeTab(tabIndex) {
        // 1. Sembunyikan semua blok konten (teks & gambar di dalamnya)
        document.querySelectorAll('.tab-content').forEach(function(content) {
            content.classList.remove('block');
            content.classList.add('hidden');
        });

        // 2. Tampilkan blok konten yang sesuai
        document.getElementById('tab-content-' + tabIndex).classList.remove('hidden');
        document.getElementById('tab-content-' + tabIndex).classList.add('block');

        // 3. Reset gaya semua tombol tab
        document.querySelectorAll('.tab-btn').forEach(function(btn) {
            btn.classList.remove('text-[#2d2f31]', 'border-[#2d2f31]');
            btn.classList.add('text-gray-500', 'border-transparent');
        });

        // 4. Beri gaya aktif pada tombol yang diklik
        let activeBtn = document.getElementById('tab-btn-' + tabIndex);
        activeBtn.classList.remove('text-gray-500', 'border-transparent');
        activeBtn.classList.add('text-[#2d2f31]', 'border-[#2d2f31]');
    }
</script>

<!-- CSS Animasi -->
<style>
    .animate-fade-in {
        animation: fadeIn 0.4s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<!--pengajar-->
<!-- Bagian Background Luar -->
<section class="bg-gray-100 py-16 w-full">
    <!-- Container Utama (Membatasi lebar maksimal agar di tengah) -->
    <div class="max-w-5xl mx-auto px-4 relative">
        
        <!-- Wadah Slider (Membatasi area yang terlihat) -->
        <div class="overflow-hidden relative">
            
            <!-- 'Rel' Slider (Yang akan digeser ke kiri/kanan oleh JavaScript) -->
            <div id="slider-track" class="flex transition-transform duration-500 ease-in-out w-full">
                
                <!-- ================= SLIDE 1 ================= -->
                <div class="min-w-full flex flex-col md:flex-row items-center gap-10 px-4 md:px-12">
                    <!-- Foto -->
                    <div class="w-full md:w-1/2 flex justify-center md:justify-end">
                        <img src="{{ asset('frank.png') }}" alt="Orang 1" class="w-64 h-64 md:w-80 md:h-80 object-cover rounded-full md:rounded-none">
                    </div>
                    <!-- Teks -->
                    <div class="w-full md:w-1/2">
                        <p class="text-gray-700 text-lg md:text-xl leading-relaxed mb-6">
                            “Saya bangga mengetahui pekerjaan saya membantu orang-orang di seluruh dunia meningkatkan karier mereka dan mengembangkan banyak hal hebat. Meski menjadi instruktur purnawaktu sangat melelahkan, profesi ini memungkinkan Anda bekerja kapan pun, di mana pun, dan bagaimana pun Anda ingin.”
                        </p>
                        <h4 class="font-bold text-[#2d2f31]">Frank Kane</h4>
                        <p class="text-gray-500 text-sm">Sertifikasi Ilmu Data & TI</p>
                    </div>
                </div>

                <!-- ================= SLIDE 2 ================= -->
                <div class="min-w-full flex flex-col md:flex-row items-center gap-10 px-4 md:px-12">
                    <!-- Foto -->
                    <div class="w-full md:w-1/2 flex justify-center md:justify-end">
                        <img src="{{ asset('paulo.png') }}" alt="Orang 2" class="w-64 h-64 md:w-80 md:h-80 object-cover rounded-full md:rounded-none">
                    </div>
                    <!-- Teks -->
                    <div class="w-full md:w-1/2">
                        <p class="text-gray-700 text-lg md:text-xl leading-relaxed mb-6">
                            "“Udemy telah mengubah hidup saya. Bersama Udemy, saya dapat mengikuti passion saya dan menjadi guru. Saya sangat gembira melihat peserta saya berhasil dan mendengar mereka mengatakan mereka telah belajar lebih banyak, lebih cepat, dari kursus saya dibandingkan yang mereka pelajari di kuliah. Ini benar-benar membuat hati saya hangat.”
                        </p>
                        <h4 class="font-bold text-[#2d2f31]">Paulo Dichone</h4>
                        <p class="text-gray-500 text-sm">Pengembang (Spesialisasi Android)</p>
                    </div>
                </div>

                <!-- ================= SLIDE 3 ================= -->
                <div class="min-w-full flex flex-col md:flex-row items-center gap-10 px-4 md:px-12">
                    <!-- Foto -->
                    <div class="w-full md:w-1/2 flex justify-center md:justify-end">
                        <img src="{{ asset('deborah.png') }}" alt="Orang 3" class="w-64 h-64 md:w-80 md:h-80 object-cover rounded-full md:rounded-none">
                    </div>
                    <!-- Teks -->
                    <div class="w-full md:w-1/2">
                        <p class="text-gray-700 text-lg md:text-xl leading-relaxed mb-6">
                            “Mengajar di Udemy telah memberi saya dua elemen penting: peluang untuk menjangkau lebih banyak peserta daripada yang bisa jangkau sendiri dan pendapatan ekstra yang stabil.”
                        </p>
                        <h4 class="font-bold text-[#2d2f31]">Deborah Grayson Riege</h4>
                        <p class="text-gray-500 text-sm">Kepemimpinan, Komunikasi</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Tombol Panah Kiri -->
        <button id="btn-prev" onclick="geserKiri()" class="absolute left-0 md:left-4 top-1/2 -translate-y-1/2 bg-white rounded-full p-4 shadow-[0_2px_4px_rgba(0,0,0,0.2)] hover:bg-gray-50 transition-all hidden flex items-center justify-center">
            <!-- Ikon Panah Kiri -->
            <svg class="w-6 h-6 text-[#2d2f31]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>

        <!-- Tombol Panah Kanan -->
        <button id="btn-next" onclick="geserKanan()" class="absolute right-0 md:right-4 top-1/2 -translate-y-1/2 bg-white rounded-full p-4 shadow-[0_2px_4px_rgba(0,0,0,0.2)] hover:bg-gray-50 transition-all flex items-center justify-center">
            <!-- Ikon Panah Kanan -->
            <svg class="w-6 h-6 text-[#2d2f31]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

    </div>
</section>

<!-- Script JavaScript untuk Logika Slider -->
<script>
    let slideSaatIni = 0; // Mulai dari slide pertama (index 0)
    const totalSlide = 3; // Karena kita punya 3 slide

    const track = document.getElementById('slider-track');
    const btnKiri = document.getElementById('btn-prev');
    const btnKanan = document.getElementById('btn-next');

    function perbaruiSlider() {
        // 1. Menggeser "rel" (track) sesuai slide saat ini
        // Jika slideSaatIni = 0 -> geser 0%
        // Jika slideSaatIni = 1 -> geser -100% (bergeser 1 layar penuh ke kiri)
        // Jika slideSaatIni = 2 -> geser -200%
        track.style.transform = `translateX(-${slideSaatIni * 100}%)`;

        // 2. Logika Menyembunyikan/Menampilkan Panah
        if (slideSaatIni === 0) {
            // Slide 1: Kiri hilang, Kanan muncul
            btnKiri.classList.add('hidden');
            btnKanan.classList.remove('hidden');
        } else if (slideSaatIni === totalSlide - 1) {
            // Slide 3 (Terakhir): Kiri muncul, Kanan hilang
            btnKiri.classList.remove('hidden');
            btnKanan.classList.add('hidden');
        } else {
            // Slide 2 (Tengah): Kiri dan Kanan muncul
            btnKiri.classList.remove('hidden');
            btnKanan.classList.remove('hidden');
        }
    }

    // Fungsi jika panah kanan dipencet
    function geserKanan() {
        if (slideSaatIni < totalSlide - 1) {
            slideSaatIni++;
            perbaruiSlider();
        }
    }

    // Fungsi jika panah kiri dipencet
    function geserKiri() {
        if (slideSaatIni > 0) {
            slideSaatIni--;
            perbaruiSlider();
        }
    }

    // Jalankan fungsi saat halaman pertama kali dimuat
    perbaruiSlider();
</script>

<!-- Section: Anda tidak perlu melakukannya sendiri -->
<section class="w-full bg-white py-16 overflow-hidden">
    <!-- Pake max-w-full biar gambar bisa bener-bener mentok ke pinggir layar -->
    <div class="max-w-full mx-auto px-4 lg:px-10">
        
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 lg:gap-10">
            
            <!-- Gambar Kiri (Gedein max-w nya) -->
            <div class="w-full md:w-auto flex justify-start">
                <img src="{{ asset('anukiri.png') }}" alt="Support Left" class="max-w-[300px] lg:max-w-[450px] w-full object-contain">
            </div>

            <!-- Area Teks Tengah (Heading + Paragraf jadi satu biar deketan) -->
            <div class="w-full md:max-w-xl lg:max-w-2xl text-center flex flex-col items-center">
                <!-- Heading satu baris dan deket ke bawah -->
                <h2 class="text-3xl md:text-[40px] font-bold text-[#2d2f31] leading-tight mb-4 whitespace-nowrap">
                    Anda tidak perlu melakukannya sendiri
                </h2>
                
                <p class="text-[#2d2f31] text-[18px] leading-relaxed mb-6">
                    <span class="font-bold">Tim Dukungan Instruktur</span> kami hadir untuk menjawab pertanyaan Anda dan mengulas video tes, sedangkan <span class="font-bold text-black">Teaching Center</span> kami akan memberi Anda banyak sumber daya untuk membantu Anda melalui proses. Dapatkan juga dukungan instruktur berpengalaman di <span class="font-bold text-black">komunitas online</span> kami.
                </p>
                
                <div class="mt-2">
                    <a href="#" class="text-[#a435f0] font-bold hover:text-[#8710d8] transition-all border-b-2 border-[#a435f0] pb-1 inline-block">
                        Perlu detail lainnya sebelum memulai? Pelajari selengkapnya.
                    </a>
                </div>
            </div>

            <!-- Gambar Kanan (Gedein max-w nya) -->
            <div class="w-full md:w-auto flex justify-end">
                <img src="{{ asset('anukanan.png') }}" alt="Support Right" class="max-w-[300px] lg:max-w-[450px] w-full object-contain">
            </div>

        </div>
    </div>
</section>
@endsection