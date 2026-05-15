<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
   public function index()
{
    // Menggunakan eager loading 'profile' agar data langsung tersedia
    $user = \App\Models\User::find(Auth::id())->load('profile');
    
    return view('profile.account', compact('user'));
}

    public function updateProfile(Request $request)
{
    /** @var \App\Models\User $user */
    $user = Auth::user(); // Menggunakan Type Hint agar VS Code tidak merah

    // 1. Simpan ke tabel user_profiles
    $user->profile()->updateOrCreate(
        ['user_id' => $user->id],
        [
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'headline'   => $request->headline,
            'bio'        => $request->bio,
            'website'    => $request->website,
            'facebook'   => $request->facebook,
            'instagram'  => $request->instagram,
            'linkedin'   => $request->linkedin,
            'tiktok'     => $request->tiktok,
            'twitter'    => $request->twitter,
            'youtube'    => $request->youtube,
        ]
        
    );

    
    $user->name = $request->first_name . ' ' . $request->last_name;
    $user->save();
    $user->profile->touch();

    return redirect()->back()->with('status', 'Profil berhasil diperbarui!');
}
    public function updateEmail(Request $request)
    {
        $request->validate([
            'new_email' => 'required|email|unique:users,email,' . Auth::id()
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->email = $request->new_email;
        $user->save();

        return back()->with('status', 'Email berhasil diperbarui!');
    }

    // Fungsi updatePassword bawaan kamu, sudah rapi dan siap pakai!
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        // Menggunakan key 'status' agar memicu alert hijau "Sandi Anda berhasil diperbarui!" di foto ketiga
        return back()->with('status', 'Sandi Anda berhasil diperbarui!');
    }

    public function showPublicProfile($id)
{
    /** @var \App\Models\User $user */
    // Mengambil user beserta data profilnya dari tabel user_profiles
    $user = \App\Models\User::with('profile')->findOrFail($id);
    
    return view('profile.public', compact('user'));
}
}