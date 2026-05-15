@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen" 
     x-data="{ activeTab: new URLSearchParams(window.location.search).get('tab') || 'keamanan' }">
    <div class="max-w-6xl mx-auto py-16 px-6 flex flex-col md:flex-row gap-10">
        
        <aside class="w-full md:w-1/4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-6">
                <div class="flex flex-col items-center">
                    <div class="relative">
                        <div class="w-24 h-24 bg-gradient-to-tr from-indigo-600 to-purple-500 text-white flex items-center justify-center rounded-2xl text-3xl font-bold mb-4 shadow-lg transform -rotate-3">
                            @php
                                $words = explode(' ', auth()->user()->name);
                                $initials = '';
                                foreach (array_slice($words, 0, 2) as $w) {
                                    $initials .= strtoupper(substr($w, 0, 1));
                                }
                            @endphp
                            {{ $initials }}
                        </div>
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

                <button @click="activeTab = 'profil'" type="button"
                    :class="activeTab === 'profil' ? 'bg-indigo-50 text-indigo-700 font-bold w-full' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 w-full'"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-left">
                    <span class="text-sm">Profil</span>
                </button>

                <button @click="activeTab = 'foto'" type="button"
                    :class="activeTab === 'foto' ? 'bg-indigo-50 text-indigo-700 font-bold w-full' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 w-full'"
                    class="group flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-left">
                    <span class="text-sm">Foto</span>
                </button>

                <button @click="activeTab = 'keamanan'" type="button"
                    :class="activeTab === 'keamanan' ? 'bg-indigo-50 text-indigo-700 font-bold w-full' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900 w-full'"
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
                        <form action="{{ route('account.profile.update') }}" method="POST" id="formProfilPublik" class="space-y-8">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
    <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Dasar-Dasar:</h3>
    
    <input type="text" name="first_name" 
        value="{{ auth()->user()->first_name ?? explode(' ', auth()->user()->name)[0] }}" 
        placeholder="Nama Depan" 
        class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm">
    
    <input type="text" name="last_name" 
    value="{{ auth()->user()->profile->last_name ?? '' }}" 
    placeholder="Nama Belakang" 
    class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm">
    
    <div class="space-y-2">
    <div class="relative">
        <input type="text" name="headline" maxlength="60" 
            value="{{ auth()->user()->profile->headline ?? '' }}" 
            placeholder="Headline" 
            class="w-full bg-white border border-slate-200 p-4 pr-12 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm">
        <span class="absolute right-4 top-4 text-slate-400 text-sm">60</span>
    </div>
    <p class="text-xs text-slate-400 ml-1">Tambahkan headline profesional, seperti "Instruktur di Udemy" atau "Arsitek".</p>
</div>

                            <div class="space-y-3">
                                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Biografi</h3>
                                <textarea name="bio" rows="4" placeholder="Ceritakan biografi Anda..." class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm">{{ auth()->user()->profile->bio ?? '' }}</textarea>
                            </div>

                            <div class="space-y-6">
    <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Tautan:</h3>

    <div class="space-y-2">
        <input type="text" name="website" value="{{ auth()->user()->website ?? '' }}" placeholder="Situs web (http(s)://..)" class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm">
    </div>

    <div class="space-y-2">
        <div class="flex h-[52px] bg-white border border-slate-200 rounded-2xl overflow-hidden focus-within:ring-4 focus-within:ring-indigo-500/10 focus-within:border-indigo-500 transition-all">
            <span class="bg-slate-50 px-4 flex items-center border-r border-slate-200 text-sm text-slate-500 select-none">facebook.com/</span>
            <input type="text" name="facebook" value="{{ auth()->user()->facebook ?? '' }}" placeholder="Nama pengguna" class="flex-1 px-4 text-sm outline-none">
        </div>
        <p class="text-xs text-slate-400 ml-1">Tambahkan nama pengguna Facebook Anda (misalnya johnsmith).</p>
    </div>

    <div class="space-y-2">
        <div class="flex h-[52px] bg-white border border-slate-200 rounded-2xl overflow-hidden focus-within:ring-4 focus-within:ring-indigo-500/10 focus-within:border-indigo-500 transition-all">
            <span class="bg-slate-50 px-4 flex items-center border-r border-slate-200 text-sm text-slate-500 select-none">instagram.com/</span>
            <input type="text" name="instagram" value="{{ auth()->user()->instagram ?? '' }}" placeholder="Nama pengguna" class="flex-1 px-4 text-sm outline-none">
        </div>
        <p class="text-xs text-slate-400 ml-1">Masukkan nama pengguna Instagram Anda (misalnya johnsmith).</p>
    </div>

    <div class="space-y-2">
        <div class="flex h-[52px] bg-white border border-slate-200 rounded-2xl overflow-hidden focus-within:ring-4 focus-within:ring-indigo-500/10 focus-within:border-indigo-500 transition-all">
            <span class="bg-slate-50 px-4 flex items-center border-r border-slate-200 text-sm text-slate-500 select-none">linkedin.com/</span>
            <input type="text" name="linkedin" value="{{ auth()->user()->linkedin ?? '' }}" placeholder="URL Profil Publik" class="flex-1 px-4 text-sm outline-none">
        </div>
        <p class="text-xs text-slate-400 ml-1">Masukkan URL profil publik LinkedIn Anda (misalnya in/johnsmith, perusahaan/udemy).</p>
    </div>

    <div class="space-y-2">
        <div class="flex h-[52px] bg-white border border-slate-200 rounded-2xl overflow-hidden focus-within:ring-4 focus-within:ring-indigo-500/10 focus-within:border-indigo-500 transition-all">
            <span class="bg-slate-50 px-4 flex items-center border-r border-slate-200 text-sm text-slate-500 select-none">tiktok.com/</span>
            <input type="text" name="tiktok" value="{{ auth()->user()->tiktok ?? '' }}" placeholder="@Username" class="flex-1 px-4 text-sm outline-none">
        </div>
        <p class="text-xs text-slate-400 ml-1">Masukkan nama pengguna TikTok Anda (misalnya @johnsmith).</p>
    </div>

    <div class="space-y-2">
        <div class="flex h-[52px] bg-white border border-slate-200 rounded-2xl overflow-hidden focus-within:ring-4 focus-within:ring-indigo-500/10 focus-within:border-indigo-500 transition-all">
            <span class="bg-slate-50 px-4 flex items-center border-r border-slate-200 text-sm text-slate-500 select-none">x.com/</span>
            <input type="text" name="twitter" value="{{ auth()->user()->twitter ?? '' }}" placeholder="Nama pengguna" class="flex-1 px-4 text-sm outline-none">
        </div>
        <p class="text-xs text-slate-400 ml-1">Tambahkan nama pengguna X Anda (misalnya johnsmith).</p>
    </div>

    <div class="space-y-2">
        <div class="flex h-[52px] bg-white border border-slate-200 rounded-2xl overflow-hidden focus-within:ring-4 focus-within:ring-indigo-500/10 focus-within:border-indigo-500 transition-all">
            <span class="bg-slate-50 px-4 flex items-center border-r border-slate-200 text-sm text-slate-500 select-none">youtube.com/</span>
            <input type="text" name="youtube" value="{{ auth()->user()->youtube ?? '' }}" placeholder="Nama pengguna" class="flex-1 px-4 text-sm outline-none">
        </div>
        <p class="text-xs text-slate-400 ml-1">Masukkan nama pengguna YouTube Anda (misalnya johnsmith).</p>
    </div>
</div>

                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-6 h-[52px] rounded-2xl transition shadow-md shadow-indigo-500/20">
                                Simpan Profil
                            </button>
                        </form>
                    </div>
                </div>

                {{-- TAB FOTO --}}
                <div x-show="activeTab === 'foto'" x-transition style="display: none;">
                    <div class="p-8 md:p-12 border-b border-slate-100 bg-white">
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Foto Profil</h1>
                        <p class="text-slate-500 mt-2 text-lg">Kelola gambar profil publik Anda di sini.</p>
                    </div>
                    <div class="p-8 md:p-12">
                        <p class="text-slate-500 text-sm italic">Fitur unggah gambar akan segera hadir.</p>
                    </div>
                </div>

                {{-- TAB KEAMANAN --}}
                <div x-show="activeTab === 'keamanan'" x-transition x-data="{ openEmailModal: false }">
                    <div class="p-8 md:p-12 border-b border-slate-100 bg-white">
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Pengaturan Keamanan</h1>
                        <p class="text-slate-500 mt-2 text-lg">Kelola kredensial login dan amankan akses akun Anda.</p>
                    </div>

                    <div class="p-8 md:p-12 space-y-10">
                        <div class="space-y-4">
                            <label class="block text-sm font-bold text-slate-700 uppercase tracking-widest">Alamat Email</label>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <div class="flex-1 bg-slate-50 border border-slate-200 rounded-2xl p-4 flex items-center group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-slate-700 font-medium truncate">{{ auth()->user()->email }}</span>
                                </div>
                                
                                <button @click="openEmailModal = true" type="button" class="bg-white border border-slate-200 text-slate-600 px-6 py-4 rounded-2xl font-bold hover:bg-slate-50 transition-all flex items-center justify-center gap-2 shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    Ubah
                                </button>
                            </div>
                        </div>

                        {{-- MODAL EMAIL --}}
                        <div x-show="openEmailModal" x-transition x-cloak
                             class="fixed inset-0 z-[9999] flex items-center justify-center bg-[#1c1d1f]/40 backdrop-blur-[2px]" style="display: none;">
                            <div @click.away="openEmailModal = false" class="relative w-full bg-white rounded-2xl shadow-2xl mx-4 p-8" style="max-width: 620px;">
                                <button @click="openEmailModal = false" type="button" class="absolute top-6 right-6 text-[#6a6f73] hover:text-black transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>

                                <h2 class="text-[22px] font-bold text-[#1c1d1f] mb-4">Ubah email Anda</h2>
                                <p class="text-[16px] leading-6 text-slate-500 mb-6">Masukkan alamat email baru yang ingin Anda gunakan. Kami akan mengirimkan kode konfirmasi ke alamat tersebut.</p>

                                <form action="{{ route('account.email.update') }}" method="POST" id="formModalEmailAsli">
                                    @csrf
                                    @method('PATCH')
                                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-widest mb-3">Masukkan email baru</label>
                                    <input type="email" name="new_email" required placeholder="name@example.com" class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm mb-6">
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-6 h-[52px] rounded-2xl transition">
                                            Verifikasi email baru saya
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <hr class="border-slate-100 my-6">

                        <form action="{{ route('account.password.update') }}" method="POST" id="formGantiPasswordAsli" class="space-y-6">
                            @csrf
                            @method('PATCH')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <label for="password" class="block text-sm font-bold text-slate-700 uppercase tracking-widest">Sandi Baru</label>
                                    <input type="password" id="password" name="password" placeholder="••••••••" required autocomplete="new-password"
                                           class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder-slate-300">
                                </div>

                                <div class="space-y-3">
                                    <label for="password_confirmation" class="block text-sm font-bold text-slate-700 uppercase tracking-widest">Konfirmasi Sandi</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required autocomplete="new-password"
                                           class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all placeholder-slate-300">
                                </div>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="bg-[#8710d8] hover:bg-[#6d28d9] text-white font-bold text-[16px] px-6 h-[52px] rounded-lg transition">
                                    Perbarui Kata Sandi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="p-8 text-center border-t border-slate-100 bg-slate-50/50">
                    <p class="text-slate-400 text-sm italic">Terakhir diperbarui: {{ auth()->user()->updated_at->diffForHumans() }}</p>
                </div>

            </div>
        </main>
    </div>
</div>
@endsection