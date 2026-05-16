<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            'twitter'    => $request->twitter,
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

public function editPhoto()
{
    // Karena sudah digabung, kita arahkan ke view account 
    // tapi sambil membawa parameter tab=foto agar Alpine.js membukanya
    return redirect()->route('account.index', ['tab' => 'foto']);
}

public function updatePhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    /** @var \App\Models\User $user */
    $user = Auth::user();

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        
        // 1. Ambil nama file lama untuk dihapus (biar tidak nyampah)
        if ($user->profile && $user->profile->photo) {
            $oldPath = public_path('storage/photos/' . $user->profile->photo);
            if (file_exists($oldPath)) {
                unlink($oldPath); // Hapus file fisik lama
            }
        }

        // 2. Buat nama file baru
        $fileName = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
        
        // 3. PERBAIKAN: Gunakan move() langsung ke public_path
        // Ini akan otomatis membuat folder 'photos' jika belum ada
        $file->move(public_path('storage/photos'), $fileName);

        // 4. Simpan hanya nama filenya saja ke database
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            ['photo' => $fileName]
        );
    }

    return redirect()->route('account.index', ['tab' => 'foto'])
                     ->with('status', 'Foto profil berhasil diperbarui!');
}

public function deletePhoto()
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Cek apakah user punya foto di profilnya
    if ($user->profile && $user->profile->photo) {
        // Hapus file foto dari folder storage/photos
        if (Storage::disk('public')->exists('photos/' . $user->profile->photo)) {
            Storage::disk('public')->delete('photos/' . $user->profile->photo);
        }

        // Set kolom photo di database menjadi null
        $user->profile()->update([
            'photo' => null
        ]);

        return redirect()->back()->with('status', 'Foto profil berhasil dihapus!');
    }

    return redirect()->back()->with('error', 'Anda tidak memiliki foto profil untuk dihapus.');
}
}