<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; 
use App\Models\Course;  
use App\Models\User;    
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function getDashboardStats()
    {
        return [
            'totalPendapatan' => Payment::where('status', 'success')->sum('amount'),
            'totalKelas'      => Course::count(),
            'totalSiswa'      => User::where('role', 'student')->count(),
            'transaksiTerbaru'=> Payment::with(['user', 'course'])->latest()->take(5)->get()
        ];
    }

    public function index()
    {
        $stats = $this->getDashboardStats();
        return view('admin.dashboard', $stats);
    }

    public function courses()
    {
        $stats = $this->getDashboardStats();
        $courses = Course::with('user')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.courses', array_merge($stats, ['courses' => $courses]));
    }

    public function users(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function transactions()
    {
        $payments = Payment::with(['user', 'course'])
                ->latest()
                ->paginate(10);
        return view('admin.transactions', compact('payments'));
    }

    public function editCourse($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses_edit', compact('course'));
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
 
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $course->update($data);        
        return redirect()->route('admin.courses')->with('success', 'Kelas berhasil diupdate!');
    }

    public function deleteCourse($id)
    {
        Course::findOrFail($id)->delete();
        return redirect()->route('admin.courses')->with('success', 'Kelas berhasil dihapus!');
    }

    public function detailTransaksi($id)
    {
        $transaksi = Payment::with(['user', 'course'])->findOrFail($id);
        return view('admin.transaksi-detail', compact('transaksi'));
    }

    public function suspendUser($id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users')->with('error', 'Tidak bisa mensuspend akun admin Anda sendiri!');
        }

        // Toggle boolean is_suspended
        $user->is_suspended = !$user->is_suspended;
        $user->save();

        $pesan = $user->is_suspended ? 'Akun pengguna berhasil disuspend!' : 'Suspend berhasil dicabut, pengguna aktif kembali!';
        return redirect()->route('admin.users')->with('success', $pesan);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users')->with('error', 'Tidak bisa menghapus akun admin Anda sendiri!');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Pengguna berhasil dihapus permanen!');
    }
}