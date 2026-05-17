@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen" x-data="{ activeTab: new URLSearchParams(window.location.search).get('tab') || 'profil' }">
    <div class="max-w-6xl mx-auto py-16 px-6 flex flex-col md:flex-row gap-10">
        
        <aside class="w-full md:w-1/4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-6">
                <div class="flex flex-col items-center">
                    <div class="relative">
                        @if($user->profile && $user->profile->photo)
                            {{-- TAMPILKAN FOTO JIKA ADA --}}
                            <img src="{{ asset('storage/photos/' . $user->profile->photo) }}" 
                                class="w-24 h-24 object-cover rounded-2xl mb-4 shadow-lg transform -rotate-3 border-4 border-white">
                            @else
                            {{-- TAMPILKAN INISIAL JIKA FOTO KOSONG --}}
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
                        {{-- Indikator Online --}}
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
                    <span class="text-sm">Lihat profil publik</span>
                </a>

                <button @click="activeTab = 'profil'; window.history.replaceState(null, '', '?tab=profil')" type="button"
                    :class="activeTab === 'profil' ? 'bg-purple-50 text-purple-700 font-bold w-full' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 w-full'"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-left">
                    <span class="text-sm">Profil</span>
                </button>

                <button @click="activeTab = 'foto'; window.history.replaceState(null, '', '?tab=foto')" type="button"
                    :class="activeTab === 'foto' ? 'bg-purple-50 text-purple-700 font-bold w-full' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 w-full'"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-left">
                    <span class="text-sm">Foto</span>
                </button>

                <button @click="activeTab = 'keamanan'; window.history.replaceState(null, '', '?tab=keamanan')" type="button"
                    :class="activeTab === 'keamanan' ? 'bg-purple-50 text-purple-700 font-bold w-full' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 w-full'"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-left">
                    <span class="text-sm">Keamanan Akun</span>
                </button>

                <a href="#" class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                    <span class="text-sm">Langganan</span>
                </a>
                <a href="#" class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                    <span class="text-sm">Metode pembayaran</span>
                </a>
                <a href="#" class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                    <span class="text-sm">Privasi</span>
                </a>
            </nav>
        </aside>

        <main class="w-full md:w-3/4">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                
                @if (session('status'))
                    <div class="m-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="m-8 bg-rose-50 border border-rose-100 text-rose-700 px-6 py-4 rounded-2xl">
                        <ul class="list-disc list-inside text-sm font-medium">
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
                        <p class="text-slate-500 mt-2 text-lg">Tambahkan informasi tentang diri Anda.</p>
                    </div>

                    <div class="p-8 md:p-12">
                        <form action="{{ route('account.profile.update') }}" method="POST" class="space-y-8">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Dasar-Dasar:</h3>
                                <input type="text" name="first_name" required value="{{ auth()->user()->profile->first_name ?? '' }}" placeholder="Nama Depan" class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all text-sm">
                                <input type="text" name="last_name" value="{{ auth()->user()->profile->last_name ?? '' }}" placeholder="Nama Belakang" class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all text-sm">
                                <div class="space-y-2">
                                    <div class="relative">
                                        <input type="text" name="headline" maxlength="60" value="{{ auth()->user()->profile->headline ?? '' }}" placeholder="Headline" class="w-full bg-white border border-slate-200 p-4 pr-12 rounded-2xl focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all text-sm">
                                        <span class="absolute right-4 top-4 text-slate-400 text-sm">60</span>
                                    </div>
                                    <p class="text-xs text-slate-400 ml-1">Tambahkan headline profesional.</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Biografi</h3>
                                <textarea name="bio" rows="4" placeholder="Ceritakan biografi Anda..." class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 transition-all text-sm">{{ auth()->user()->profile->bio ?? '' }}</textarea>
                            </div>

                            
                            <div class="space-y-6">
                                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Tautan:</h3>
    
                                @php 
                                    $sosmeds = [
                                        'website'   => ['domain' => 'Situs web (http(s)://..)', 'placeholder' => '', 'hint' => ''],
                                        'facebook'  => ['domain' => 'facebook.com/', 'placeholder' => 'Nama pengguna', 'hint' => 'Tambahkan nama pengguna Facebook Anda (misalnya johnsmith).'],
                                        'instagram' => ['domain' => 'instagram.com/', 'placeholder' => 'Nama pengguna', 'hint' => 'Masukkan nama pengguna Instagram Anda (misalnya johnsmith).'],
                                        'twitter'   => ['domain' => 'x.com/', 'placeholder' => 'Nama pengguna', 'hint' => 'Tambahkan nama pengguna X Anda (misalnya johnsmith).']
            
                                    ]; 
                                @endphp

                                @foreach($sosmeds as $field => $data)
                                    <div class="space-y-2">
                                        <div class="flex">
                                        @if($field === 'website')
                                            {{-- Khusus Website tampilannya full input --}}
                                            <input type="text" name="{{ $field }}" 
                                            value="{{ auth()->user()->profile->$field ?? '' }}" 
                                            placeholder="{{ $data['domain'] }}" 
                                            class="w-full bg-white border border-slate-300 p-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-slate-400 transition-all text-sm text-slate-600">
                                        @else

                                            {{-- Tampilan Input Group untuk Sosmed --}}
                                            <span class="inline-flex items-center px-5 rounded-l-xl border border-r-0 border-slate-300 bg-slate-50          text-slate-500 text-sm min-w-[140px] justify-center">
                                                {{ $data['domain'] }}
                                            </span>
                                            <input type="text" name="{{ $field }}" 
                                            value="{{ auth()->user()->profile->$field ?? '' }}" 
                                            placeholder="{{ $data['placeholder'] }}" 
                                            class="flex-1 bg-white border border-slate-300 p-4 rounded-r-xl focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-slate-400 transition-all text-sm text-slate-600">
                                        @endif
                                        </div>
            
                                        @if($data['hint'])
                                            <p class="text-[12px] text-slate-500 ml-1">{{ $data['hint'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold text-sm px-6 h-[52px] rounded-2xl transition shadow-md">
                                Simpan Profil
                            </button>
                        </form>
                    </div>
                </div>

                {{-- TAB FOTO --}}
                <div x-show="activeTab === 'foto'" x-transition x-cloak>
                    <div class="p-8 md:p-12 border-b border-slate-100 bg-white">
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Foto Profil</h1>
                        <p class="text-slate-500 mt-2 text-lg">Kelola gambar profil publik Anda di sini.</p>
                    </div>

                    <div class="p-8 md:p-12">
                        <form action="{{ route('settings.photo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        {{-- Pratinjau Gambar --}}
                        <div class="space-y-4">
                            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Pratinjau gambar:</h3>
                                <div class="flex justify-center bg-slate-50 border border-dashed border-slate-200 rounded-3xl p-12">
                                    <div class="relative group">
                                        <img id="image-preview" 
                                        src="{{ $user->profile && $user->profile->photo ? asset('storage/photos/' . $user->profile->photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" 
                                        class="w-56 h-56 object-cover rounded-2xl shadow-2xl border-4 border-white transition-transform group-hover:scale-105">
                                    </div>
                                </div>
                        </div>

                        {{-- Input File --}}
                        <div class="space-y-4">
                            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Tambah/Ganti Gambar:</h3>
                                <div class="flex flex-col md:flex-row gap-3">
                                    <input type="text" id="file-name-display" readonly placeholder="Tidak ada file yang dipilih"
                                    class="flex-1 bg-slate-50 border border-slate-200 p-4 rounded-2xl text-sm text-slate-600 focus:outline-none">
                                    <label for="photo-input" class="cursor-pointer bg-white border-2 border-purple-600 text-purple-600 px-8 py-4 rounded-2xl font-bold text-sm hover:bg-purple-50 transition-all text-center">
                                        Pilih File
                                    </label>
                                    <input type="file" name="photo" id="photo-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                                </div>
                                @error('photo')
                                    <p class="text-red-500 text-xs mt-2 ml-1">{{ $message }}</p>
                                @enderror
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="pt-6 border-t border-slate-50">
                            <button type="submit" class="bg-purple-600 text-white px-12 py-4 rounded-2xl font-bold hover:bg-purple-700 shadow-lg shadow-purple-200 transition-all w-full md:w-auto">
                                Simpan Foto
                            </button>
                        </div>
                        </form>

                        <div class="mt-4 flex items-center gap-4">
                        {{-- Tombol Hapus hanya muncul jika user memang punya foto profil di database --}}
                        @if(Auth::user()->profile && Auth::user()->profile->photo)
                            <form action="{{ route('account.avatar.delete') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto profil ini?')">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-700 px-4 py-2 rounded-xl font-bold text-sm transition cursor-pointer">
                                    Hapus Foto Profil
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
                        <p class="text-slate-500 mt-2 text-lg">Kelola kredensial login dan amankan akses akun Anda.</p>
                    </div>

                    <div class="p-8 md:p-12 space-y-10">
                        <div class="space-y-4">
                            <label class="block text-sm font-bold text-slate-700 uppercase tracking-widest">Alamat Email</label>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="flex-1 bg-slate-50 border border-slate-200 rounded-2xl p-4 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                    <span class="text-slate-700 font-medium">{{ auth()->user()->email }}</span>
                                </div>
                                <button @click="openEmailModal = true" type="button" class="bg-white border border-slate-200 text-slate-600 px-6 py-4 rounded-2xl font-bold hover:bg-slate-50">Ubah</button>
                            </div>
                        </div>

                        {{-- MODAL EMAIL --}}
                        <div x-show="openEmailModal" x-transition x-cloak class="fixed inset-0 z-[9999] flex items-center justify-center bg-[#1c1d1f]/40 backdrop-blur-[2px]">
                            <div @click.away="openEmailModal = false" class="relative w-full bg-white rounded-2xl shadow-2xl mx-4 p-8 max-w-[620px]">
                                <button @click="openEmailModal = false" type="button" class="absolute top-6 right-6 text-slate-400 hover:text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                                <h2 class="text-xl font-bold mb-4">Ubah email Anda</h2>
                                <form action="{{ route('account.email.update') }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="email" name="new_email" required placeholder="name@example.com" class="w-full border border-slate-200 p-4 rounded-2xl mb-6">
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-purple-600 text-white px-6 py-3 rounded-2xl font-bold">Verifikasi email baru</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr class="border-slate-100 my-6">

                        <form action="{{ route('account.password.update') }}" method="POST" class="space-y-6">
                            @csrf @method('PATCH')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-widest">Sandi Baru</label>
                                    <input type="password" name="password" placeholder="••••••••" required class="w-full border border-slate-200 p-4 rounded-2xl">
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-widest">Konfirmasi Sandi</label>
                                    <input type="password" name="password_confirmation" placeholder="••••••••" required class="w-full border border-slate-200 p-4 rounded-2xl">
                                </div>
                            </div>
                            <button type="submit" class="bg-[#8710d8] text-white font-bold px-6 py-4 rounded-lg">Perbarui Kata Sandi</button>
                        </form>
                    </div>
                </div>

                <div class="p-8 text-center border-t border-slate-100 bg-slate-50/50">
                    <p class="text-slate-400 text-sm italic">Terakhir diperbarui: {{ auth()->user()->profile->updated_at->diffForHumans() }}</p>
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