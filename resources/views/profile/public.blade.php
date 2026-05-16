@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="h-32 bg-[#a435f0]"></div> 
                <div class="px-8 pb-8">
                    <div class="relative flex justify-between items-end -mt-12 mb-6">
                        <div class="w-32 h-32 bg-white p-2 rounded-full shadow-lg overflow-hidden flex items-center justify-center">
                        @if($user->profile && $user->profile->photo)
                        {{-- TAMPILKAN FOTO JIKA ADA --}}
                            <img src="{{ asset('storage/photos/' . $user->profile->photo) }}" 
                            class="w-full h-full rounded-full object-cover">
                        @else
                            {{-- FALLBACK KE INISIAL HURUF HITAM JIKA KOSONG --}}
                            <div class="w-full h-full bg-[#2d2f31] rounded-full flex items-center justify-center text-4xl font-bold text-white">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                        </div>
                    
                        @if(auth()->id() == $user->id)
                            <a href="{{ url('/pengaturan-akun?tab=profil') }}" 
                                class="group flex items-center justify-center gap-2 border-2 border-[#a435f0] text-[#a435f0] hover:bg-[#f7f9fa] font-bold py-2.5 px-6 rounded-md transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#a435f0]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                                <span class="text-[15px]">Edit profil</span>
                            </a>
                        @endif
                    </div>

                    <div class="space-y-1">
                        <h1 class="text-3xl font-extrabold text-slate-900">{{ $user->name }}</h1>
                            <p class="text-lg font-bold text-slate-600">
                            {{ $user->profile->headline ?? 'Belum ada headline' }}
                            </p>
                    </div>

                        <div class="flex flex-wrap items-center gap-5 mt-6">

                        @php 
                            $sosmeds = [
                                'website' => 'globe', 
                                'facebook' => 'facebook', 
                                'instagram' => 'instagram', 
                                'twitter' => 'twitter'    
                                ]; 
                        @endphp

                        @foreach($sosmeds as $field => $icon)
                            @if(!empty($user->profile->$field))
                                @php
                                $value = $user->profile->$field;
                                if (str_contains($value, 'http')) {
                                    $url = $value;
                                } else {
                                if ($field == 'website') {
                                    $url = 'https://' . $value;
                                } elseif ($field == 'twitter') {
                                    $url = 'https://twitter.com/' . $value;
                                } else {
                                    $url = 'https://' . $field . '.com/' . $value;
                                }
                                }
                                @endphp<a href="{{ $url }}" target="_blank" class="text-slate-500 hover:text-[#a435f0] transition-colors text-xl inline-flex items-center justify-center"><i class="fab fa-{{ $icon }}"></i></a>@endif @endforeach
                        </div>

                        <div class="mt-8 bg-white rounded-2xl p-8 border border-slate-200 shadow-sm">
                            <h2 class="text-xl font-bold text-slate-900 mb-4">Tentang saya</h2>
                                <div class="text-slate-700 leading-relaxed text-[16px]">
                                {!! nl2br(e($user->profile->bio ?? 'User ini belum menulis biografi.')) !!}
                                </div>
                    </div>
                </div>
            </div>    
        </div>        
    </div>
</div>
@endsection