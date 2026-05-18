@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen" x-data="{ activeTab: new URLSearchParams(window.location.search).get('tab') || 'profil' }">
    <div class="max-w-6xl mx-auto py-16 px-6 flex flex-col md:flex-row gap-10">
        
        {{-- SIDEBAR NAVIGASI PENGATURAN --}}
        <aside class="w-full md:w-1/4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-6">
                <div class="flex flex-col items-center">
                    <div class="relative">
                        @if($user->profile && $user->profile->photo)
                            <img src="{{ asset('storage/photos/' . $user->profile->photo) }}" 
                                 class="w-24 h-24 object-cover rounded-2xl mb-4 shadow-lg transform -rotate-3 border-4 border-white">
                        @else
                            {{-- TAMPILKAN INISIAL NAMA JIKA FOTO BELUM DIUNGGAH --}}
                            <div class="w-24 h-24 bg-gradient-to-tr from-purple-600 to-purple-500 text-white flex items-center justify-center rounded-2xl text-3xl font-bold mb-4 shadow-lg transform -rotate-3">
                            @php
                                $words = explode(' ', auth()->user()->name);
                                $initials = '';
                                foreach (array_slice($words, 0, 2) as $w) {
                                    $initials .= strtoupper(substr($w, 0, 1));
                                }
                            @endphp
                            {{ $initials }}
                            </div>
                        @endif
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
                    </div>

                    <h2 class="text-xl font-extrabold text-slate-800 text-center leading-tight mt-2">
                        {{ auth()->user()->name }}
                    </h2>
                    <p class="text-xs text-slate-500 mt-1 uppercase tracking-wider font-semibold">Personal Account</p>
                </div>
            </div>

            <nav class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden p-2 space-y-1">
                <a href="{{ route('profile.public', auth()->id()) }}" class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                    <span class="text-sm font-semibold">Lihat profil publik</span>
                </a>

                <button @click="activeTab = 'profil'; window.history.replaceState(null, '', '?tab=profil')" type="button"
                    :class="activeTab === 'profil' ? 'bg-purple-50 text-purple-700 font-bold w-full' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 w-full'"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-left cursor-pointer">
                    <span class="text-sm">Profil</span>
                </button>

                <button @click="activeTab = 'foto'; window.history.replaceState(null, '', '?tab=foto')" type="button"
                    :class="activeTab === 'foto' ? 'bg-purple-50 text-purple-700 font-bold w-full' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 w-full'"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-left cursor-pointer">
                    <span class="text-sm">Foto</span>
                </button>

                <button @click="activeTab = 'keamanan'; window.history.replaceState(null, '', '?tab=keamanan')" type="button"
                    :class="activeTab === 'keamanan' ? 'bg-purple-50 text-purple-700 font-bold w-full' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 w-full'"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-left cursor-pointer">
                    <span class="text-sm">Keamanan Akun</span>
                </button>
            </nav>
        </aside>

        {{-- AREA UTAMA KONTEN FORMULIR --}}
        <main class="w-full md:w-3/4">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                
                @if (session('status'))
                    <div class="m-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl">
                        <span class="font-bold text-sm">✓ {{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="m-8 bg-rose-50 border border-rose-100 text-rose-700 px-6 py-4 rounded-2xl">
                        <ul class="list-disc list-inside text-sm font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- TAB PROFIL --}}
                <div x-show="activeTab === 'profil'" x-transition>
                    <div class="p-8 md:p-12 border-b border-slate-100 bg-white">
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Profil Publik</h1>
                        <p class="text-slate-500 mt-2 text-base">Tambahkan informasi tentang diri Anda agar dikenal siswa.</p>
                    </div>

                    <div class="p-8 md:p-12">
                        <form action="{{ route('account.profile.update') }}" method="POST" class="space-y-8">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Dasar-Dasar:</h3>
                                <input type="text" name="first_name" required value="{{ auth()->user()->profile->first_name ?? '' }}" placeholder="Nama Depan" class="w-full bg-white border border-slate-200 p-4 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all text-sm font-semibold text-gray-700">
                                <input type="text" name="last_name" value="{{ auth()->user()->profile->last_name ?? '' }}" placeholder="Nama Belakang" class="w-full bg-white border border-slate-200 p-4 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all text-sm font-semibold text-gray-700">
                                
                                <div class="space-y-2">
                                    <div class="relative">
                                        <input type="text" name="headline" maxlength="60" value="{{ auth()->user()->profile->headline ?? '' }}" placeholder="Headline Profesional" class="w-full bg-white border border-slate-200 p-4 pr-12 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all text-sm font-semibold text-gray-700">
                                        <span class="absolute right-4 top-4 text-slate-400 text-xs font-bold">60</span>
                                    </div>
                                    <p class="text-xs text-slate-400 ml-1">Tambahkan headline pekerjaan (misal: "Full Stack Engineer").</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Biografi Singkat</h3>
                                <textarea name="bio" rows="4" placeholder="Ceritakan pengabdian akademis atau biografi singkat Anda..." class="w-full bg-white border border-slate-200 p-4 rounded-xl focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all text-sm font-medium text-gray-700 leading-relaxed resize-none">{{ auth()->user()->profile->bio ?? '' }}</textarea>
                            </div>

                            <div class="space-y-6">
                                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Tautan Jejaring Sosial:</h3>
                                @php 
                                    $sosmeds = [
                                        'website'   => ['domain' => 'Situs web URL', 'placeholder' => 'https://domainku.com', 'hint' => 'Masukkan tautan portofolio eksternal Anda.'],
                                        'facebook'  => ['domain' => 'facebook.com/', 'placeholder' => 'username', 'hint' => 'Tambahkan identitas profil Facebook.'],
                                        'instagram' => ['domain' => 'instagram.com/', 'placeholder' => 'username', 'hint' => 'Masukkan identitas galeri Instagram.'],
                                        'twitter'   => ['domain' => 'x.com/', 'placeholder' => 'username', 'hint' => 'Tambahkan identitas microblog X Anda.']
                                    ]; 
                                @endphp

                                @foreach($sosmeds as $field => $data)
                                    <div class="space-y-2">
                                        <div class="flex shadow-sm rounded-xl overflow-hidden">
                                        @if($field === 'website')
                                            <input type="url" name="{{ $field }}" value="{{ auth()->user()->profile->$field ?? '' }}" placeholder="{{ $data['placeholder'] }}" class="w-full bg-white border border-slate-200 p-4 outline-none focus:border-purple-500 transition-all text-sm font-semibold text-gray-700">
                                        @else
                                            <span class="inline-flex items-center px-5 border border-r-0 border-slate-200 bg-slate-50 text-slate-500 text-xs font-bold min-w-[140px] justify-center">
                                                {{ $data['domain'] }}
                                            </span>
                                            <input type="text" name="{{ $field }}" value="{{ auth()->user()->profile->$field ?? '' }}" placeholder="{{ $data['placeholder'] }}" class="flex-1 bg-white border border-slate-200 p-4 outline-none focus:border-purple-500 transition-all text-sm font-semibold text-gray-700">
                                        @endif
                                        </div>
                                        <p class="text-[11px] text-slate-400 ml-1 font-medium">{{ $data['hint'] }}</p>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold text-xs uppercase tracking-widest px-8 h-[52px] rounded-xl transition shadow-md active:scale-95 cursor-pointer">
                                Simpan Profil
                            </button>
                        </form>
                    </div>
                </div>

                {{-- TAB FOTO --}}
                <div x-show="activeTab === 'foto'" x-transition x-cloak>
                    <div class="p-8 md:p-12 border-b border-slate-100 bg-white">
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Foto Profil</h1>
                        <p class="text-slate-500 mt-2 text-base">Kelola gambar gambar profil publik Anda di sini.</p>
                    </div>

                    <div class="p-8 md:p-12">
                        <form action="{{ route('settings.photo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf @method('PUT')
                        <div class="space-y-4">
                            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Pratinjau gambar saat ini:</h3>
                            <div class="flex justify-center bg-slate-50 border border-dashed border-slate-200 rounded-3xl p-12">
                                <img id="image-preview" 
                                     src="{{ $user->profile && $user->profile->photo ? asset('storage/photos/' . $user->profile->photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                                     class="w-56 h-56 object-cover rounded-2xl shadow-xl border-4 border-white transition-transform duration-200">
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Tambah/Ganti Gambar Baru:</h3>
                            <div class="flex flex-col md:flex-row gap-3">
                                <input type="text" id="file-name-display" readonly placeholder="Tidak ada berkas gambar terpilih" class="flex-1 bg-slate-50 border border-slate-200 p-4 rounded-xl text-sm font-semibold text-slate-500 focus:outline-none">
                                <label for="photo-input" class="cursor-pointer bg-white border-2 border-purple-600 text-purple-600 px-8 py-4 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-purple-50 transition-all text-center flex items-center justify-center">
                                    Pilih Berkas
                                </label>
                                <input type="file" name="photo" id="photo-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 flex flex-col md:flex-row gap-4 items-center">
                            <button type="submit" class="bg-purple-600 text-white px-12 py-4 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-purple-700 shadow-lg transition-all w-full md:w-auto cursor-pointer active:scale-95">
                                Unggah Foto Baru
                            </button>
                        </form>

                        @if(Auth::user()->profile && Auth::user()->profile->photo)
                            <form action="{{ route('account.avatar.delete') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto profil ini?')" class="m-0 w-full md:w-auto">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-600 px-6 py-4 rounded-xl font-bold text-xs uppercase tracking-widest transition cursor-pointer active:scale-95">
                                    Hapus Foto
                                </button>
                            </form>
                        @endif
                        </div>
                    </div>
                </div>

                {{-- TAB KEAMANAN --}}
                <div x-show="activeTab === 'keamanan'" x-transition x-cloak x-data="{ openEmailModal: false }">
                    <div class="p-8 md:p-12 border-b border-slate-100 bg-white">
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Pengaturan Keamanan</h1>
                        <p class="text-slate-500 mt-2 text-base">Kelola kredensial login dan amankan hak akses akun Anda.</p>
                    </div>

                    <div class="p-8 md:p-12 space-y-10">
                        <div class="space-y-4">
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest">Alamat Akun Email</label>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="flex-1 bg-slate-50 border border-slate-200 rounded-xl p-4 flex items-center">
                                    <span class="text-gray-700 font-semibold text-sm font-mono">{{ auth()->user()->email }}</span>
                                </div>
                                <button @click="openEmailModal = true" type="button" class="bg-white border border-slate-200 text-slate-600 px-6 py-4 rounded-xl font-bold text-xs uppercase tracking-wider hover:bg-slate-50 cursor-pointer">Ubah</button>
                            </div>
                        </div>

                        {{-- MODAL GANTI EMAIL --}}
                        <div x-show="openEmailModal" x-cloak x-transition class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/40 backdrop-blur-[1px]">
                            <div @click.away="openEmailModal = false" class="relative w-full bg-white rounded-2xl shadow-2xl mx-4 p-8 max-w-[620px]">
                                <button @click="openEmailModal = false" type="button" class="absolute top-6 right-6 text-slate-400 hover:text-black cursor-pointer">
                                    <i class="fas fa-times text-lg"></i>
                                </button>
                                <h2 class="text-xl font-black mb-2">Ubah alamat email Anda</h2>
                                <form action="{{ route('account.email.update') }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="email" name="new_email" required placeholder="nama-baru@example.com" class="w-full border border-slate-200 p-4 rounded-xl mb-6 outline-none focus:border-purple-500 font-semibold text-sm">
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-purple-600 text-white px-6 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest cursor-pointer hover:bg-purple-700 shadow-md">Verifikasi email baru</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr class="border-slate-100 my-6">

                        {{-- FORMULIR UPDATE PASSWORD SECURITY --}}
                        <form action="{{ route('account.password.update') }}" method="POST" class="space-y-6">
                            @csrf @method('PATCH')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest">Kata Sandi Baru</label>
                                    <input type="password" name="password" placeholder="••••••••" required class="w-full border border-slate-200 p-4 rounded-xl outline-none focus:border-purple-500">
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest">Konfirmasi Sandi Baru</label>
                                    <input type="password" name="password_confirmation" placeholder="••••••••" required class="w-full border border-slate-200 p-4 rounded-xl outline-none focus:border-purple-500">
                                </div>
                            </div>
                            <button type="submit" class="bg-[#5624d0] text-white font-bold text-xs uppercase tracking-widest px-6 py-4 rounded-xl hover:bg-purple-900 shadow-md active:scale-95 cursor-pointer">Perbarui Kata Sandi</button>
                        </form>
                    </div>
                </div>

                {{-- FOOTER TIMESTAMP DETAIL (SUDAH DIPROTEKSI NULL POINTER) --}}
                <div class="p-6 text-center border-t border-slate-100 bg-slate-50/50">
                    <p class="text-slate-400 text-xs italic">
                        Terakhir diperbarui: {{ auth()->user()->profile ? auth()->user()->profile->updated_at->diffForHumans() : 'Baru saja' }}
                    </p>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const fileNameDisplay = document.getElementById('file-name-display');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            fileNameDisplay.value = input.files[0].name;

            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection