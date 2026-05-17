<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; 
use App\Models\Course;  
use App\Models\User;    

class AdminController extends Controller
{
    public function index()
    {
        $totalPendapatan = Payment::where('status', 'success')->sum('amount');
        $totalKelas = Course::count();
        $totalSiswa = User::where('role', 'student')->count();
        
        // FAKTANYA: Load relasi langsung ke user dan course di dashboard admin
        $transaksiTerbaru = Payment::with(['user', 'course'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPendapatan', 
            'totalKelas', 
            'totalSiswa', 
            'transaksiTerbaru'
        ));
    }

    public function courses()
    {
        $totalPendapatan = Payment::where('status', 'success')->sum('amount');
        $totalKelas = Course::count();
        $totalSiswa = User::where('role', 'student')->count();
        $transaksiTerbaru = Payment::with(['user', 'course'])->latest()->take(5)->get();

        $courses = Course::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.courses', compact(
            'courses', 
            'totalPendapatan', 
            'totalKelas', 
            'totalSiswa', 
            'transaksiTerbaru'
        ));
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

    // FAKTANYA: Fungsi Transaksi diperbaiki total agar memanggil relasi baru secara langsung
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
        // FAKTANYA: Load relasi langsung untuk kebutuhan halaman detail invoice admin
        $transaksi = Payment::with(['user', 'course'])->findOrFail($id);
        return view('admin.transaksi-detail', compact('transaksi'));
    }
}