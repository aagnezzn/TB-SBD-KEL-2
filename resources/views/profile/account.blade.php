@extends('layouts.app')

@section('content')
<!-- Quill API Stylesheet & Script -->
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

{{-- Mengatasi Tailwind Reset & Custom Styling Editor --}}
<style>
    .ql-editor {
        min-height: 160px;
        font-size: 0.875rem !important;
        color: #334155 !important;
    }
    .ql-container.ql-snow {
        border: none !important;
    }
    .ql-editor.ql-blank::before {
        left: 1rem;
        color: #94a3b8;
        font-style: normal;
    }
    [x-cloak] { display: none !important; }
</style>

<div class="bg-slate-50 min-h-screen" x-data="{ activeTab: 'profil' }">
    <div class="max-w-6xl mx-auto py-16 px-6 flex flex-col md:flex-row gap-10">
        
        <!-- SIDEBAR -->
        <aside class="w-full md:w-1/4">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-6">
                <div class="flex flex-col items-center">
                    <div class="relative">
                        {{-- AVATAR / INISIAL OTOMATIS --}}
                        <div class="w-24 h-24 bg-gradient-to-tr from-indigo-600 to-purple-500 text-white flex items-center justify-center rounded-2xl text-3xl font-bold mb-4 shadow-lg transform -rotate-3">
                            @php
                                // Mengambil inisial dari nama user
                                $full_name = auth()->user()->name ?? (auth()->user()->profile->first_name ?? 'User');
                                $words = explode(' ', $full_name);
                                $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                            @endphp
                            {{ $initials }}
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 border-4 border-white rounded-full"></div>
                    </div>
                    
                    {{-- NAMA USER DINAMIS --}}
                    <h2 class="text-xl font-extrabold text-slate-800 text-center leading-tight mt-2">
                        {{ auth()->user()->name }}
                    </h2>
                    <p class="text-xs text-slate-500 mt-1 uppercase tracking-wider font-semibold">Akun Personal</p>
                </div>
            </div>

            <nav class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden p-2 space-y-1">
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
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="w-full md:w-3/4">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                
                {{-- Flash Message --}}
                @if (session('status'))
                    <div class="m-8 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">{{ session('status') }}</span>
                    </div>
                @endif

                {{-- TAB: PROFIL --}}
                <div x-show="activeTab === 'profil'" x-transition>
                    <div class="p-8 md:p-12 border-b border-slate-100 bg-white">
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Profil Publik</h1>
                        <p class="text-slate-500 mt-2 text-lg">Kelola informasi publik Anda, <strong>{{ auth()->user()->name }}</strong>.</p>
                    </div>

                    <div class="p-8 md:p-12">
                        <form action="{{ route('account.profile.update') }}" method="POST" id="formProfilPublik" class="space-y-8">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Dasar-Dasar:</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <input type="text" name="first_name" required value="{{ old('first_name', auth()->user()->profile->first_name ?? '') }}" placeholder="Nama Depan" class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm">
                                    <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->profile->last_name ?? '') }}" placeholder="Nama Belakang" class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm">
                                </div>
                                
                                <div class="relative">
                                    <input type="text" name="headline" maxlength="60" value="{{ old('headline', auth()->user()->profile->headline ?? '') }}" placeholder="Headline Profesional" class="w-full bg-white border border-slate-200 p-4 pr-12 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all text-sm">
                                    <span class="absolute right-4 top-4 text-slate-400 text-sm">60</span>
                                </div>
                            </div>

                            {{-- BIOGRAFI --}}
                            <div class="space-y-3">
                                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Biografi</h3>
                                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
                                    <div id="editor-container">
                                        {!! auth()->user()->profile->bio ?? '' !!}
                                    </div>
                                </div>
                                <textarea name="bio" id="bio-hidden" class="hidden"></textarea>
                            </div>

                            {{-- SOSIAL MEDIA --}}
                            <div class="space-y-4">
                                <h3 class="text-sm font-bold text-slate-700 uppercase tracking-widest">Tautan Media Sosial:</h3>
                                @php
                                    $socials = [
                                        ['name' => 'website', 'label' => 'website (http/s)', 'placeholder' => 'Link website'],
                                        ['name' => 'facebook', 'label' => 'facebook.com/', 'placeholder' => 'Username'],
                                        ['name' => 'instagram', 'label' => 'instagram.com/', 'placeholder' => 'Username'],
                                        ['name' => 'linkedin', 'label' => 'linkedin.com/', 'placeholder' => 'URL Profil'],
                                    ];
                                @endphp

                                @foreach($socials as $social)
                                <div class="flex h-[52px] bg-white border border-slate-200 rounded-2xl overflow-hidden focus-within:ring-4 focus-within:ring-indigo-500/10 focus-within:border-indigo-500 transition-all">
                                    <span class="bg-slate-50 px-4 flex items-center border-r border-slate-200 text-sm text-slate-500 select-none w-40">{{ $social['label'] }}</span>
                                    <input type="text" name="{{ $social['name'] }}" value="{{ old($social['name'], auth()->user()->profile->{$social['name']} ?? '') }}" class="flex-1 px-4 text-sm outline-none" placeholder="{{ $social['placeholder'] }}">
                                </div>
                                @endforeach
                            </div>

                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm px-8 h-[52px] rounded-2xl transition shadow-md shadow-indigo-500/20">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>

                {{-- TAB: KEAMANAN --}}
                <div x-show="activeTab === 'keamanan'" x-transition x-cloak>
                    <div class="p-8 md:p-12 border-b border-slate-100 bg-white">
                        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Keamanan Akun</h1>
                        <p class="text-slate-500 mt-2 text-lg">Email login Anda saat ini adalah: <strong>{{ auth()->user()->email }}</strong></p>
                    </div>
                    
                    <div class="p-8 md:p-12">
                        <form action="{{ route('account.password.update') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-slate-700">Sandi Baru</label>
                                    <input type="password" name="password" required class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-slate-700">Konfirmasi Sandi</label>
                                    <input type="password" name="password_confirmation" required class="w-full bg-white border border-slate-200 p-4 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all">
                                </div>
                            </div>
                            <button type="submit" class="bg-purple-700 hover:bg-purple-800 text-white font-bold px-6 py-4 rounded-xl transition">
                                Perbarui Kata Sandi
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            modules: { toolbar: false },
            placeholder: 'Ceritakan sedikit tentang diri Anda...'
        });

        var form = document.getElementById('formProfilPublik');
        var hiddenArea = document.getElementById('bio-hidden');

        form.addEventListener('submit', function() {
            hiddenArea.value = quill.root.innerHTML;
        });
    });
</script>
@endsection