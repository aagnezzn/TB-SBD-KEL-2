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
        $transaksiTerbaru = Payment::latest()->take(5)->get();

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
        $transaksiTerbaru = Payment::latest()->take(5)->get();

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
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users', compact('users'));
    }

    // Fungsi untuk halaman Transaksi
    public function transactions()
    {
        $payments = Payment::with(['enrollment.user', 'enrollment.course'])
                ->latest()
                ->paginate(10);
        return view('admin.transactions', compact('payments'));
    }

    //fungsi halaman edit
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

    //fungsi hapus kursus
    public function deleteCourse($id)
    {
        Course::findOrFail($id)->delete();
        return redirect()->route('admin.courses')->with('success', 'Kelas berhasil dihapus!');
    }

    //fungsi halaman detail transaksi
    public function detailTransaksi($id)
    {
        $transaksi = Payment::findOrFail($id);
        return view('admin.transaksi-detail', compact('transaksi'));
    }
}