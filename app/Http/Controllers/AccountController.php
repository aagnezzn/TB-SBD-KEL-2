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
    /** @var \App\Models\User $user */
    $user = \App\Models\User::find(Auth::id());

    // JIKA AKUN BARU BELUM PUNYA PROFIL, OTOMATIS BUATKAN RECORD KOSONG DI DATABASE
    if (!$user->profile) {
        $user->profile()->create([
            'first_name' => explode(' ', $user->name)[0] ?? 'User',
            'last_name'  => explode(' ', $user->name)[1] ?? '',
        ]);
        
        // Muat ulang data user beserta profil barunya
        $user->load('profile');
    }

    return view('profile.account', compact('user'));

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

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'Sandi Anda berhasil diperbarui!');
    }

    public function showPublicProfile($id)
    {
    /** @var \App\Models\User $user */
    $user = \App\Models\User::with('profile')->findOrFail($id);
    
    return view('profile.public', compact('user'));
    }

    public function editPhoto()
    {
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

        if ($user->profile && $user->profile->photo) {
            $oldPath = public_path('storage/photos/' . $user->profile->photo);
            if (file_exists($oldPath)) {
                unlink($oldPath); // Hapus file fisik lama
            }
        }

        $fileName = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage/photos'), $fileName);
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

    if ($user->profile && $user->profile->photo) {
        if (Storage::disk('public')->exists('photos/' . $user->profile->photo)) {
            Storage::disk('public')->delete('photos/' . $user->profile->photo);
        }

        $user->profile()->update([
            'photo' => null
        ]);

        return redirect()->back()->with('status', 'Foto profil berhasil dihapus!');
    }

    return redirect()->back()->with('error', 'Anda tidak memiliki foto profil untuk dihapus.');
    }
}