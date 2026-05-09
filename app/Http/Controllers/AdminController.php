<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment; // Untuk hitung pendapatan & tabel transaksi
use App\Models\Course;  // Untuk hitung total kelas
use App\Models\User;    // Untuk hitung total siswa

class AdminController extends Controller
{
    public function index()
    {
        // 1. Hitung total pendapatan (hanya yang statusnya 'success')
        $totalPendapatan = Payment::where('status', 'success')->sum('amount');

        // 2. Hitung total kelas yang tersedia
        $totalKelas = Course::count();

        // 3. Hitung total pengguna (siswa)
        $totalSiswa = User::count();

        // 4. Ambil 5 transaksi terbaru untuk ditampilkan di tabel
        $transaksiTerbaru = Payment::latest()->take(5)->get();

        // Lempar semua variabel ini ke halaman dashboard.blade.php
        return view('admin.dashboard', compact(
            'totalPendapatan', 
            'totalKelas', 
            'totalSiswa', 
            'transaksiTerbaru'
        ));
    }

    public function courses()
    {
        // Ambil semua data kelas dari database, urutkan dari yang terbaru
        $courses = Course::orderBy('created_at', 'desc')->get();

        // Lempar datanya ke file view admin/courses.blade.php
        return view('admin.courses', compact('courses'));
    }

    public function transactions()
    {
    // Ambil data payment, sertakan relasi enrollment, user, dan course agar tidak berat (Eager Loading)
    $payments = Payment::with(['enrollment.user', 'enrollment.course'])
                ->latest()
                ->get();

    return view('admin.transactions', compact('payments'));
    }

    public function users()
    {
    // Ambil semua user kecuali admin (opsional, tapi biasanya admin nggak perlu masuk daftar)
    $users = \App\Models\User::where('role', 'student')->latest()->get();

    return view('admin.users', compact('users'));
    }

    public function createCourse()
    {
    return view('admin.courses_create');
    }

    // Proses Simpan Kelas Baru
    public function storeCourse(Request $request)
    {
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'image_url' => 'nullable|url'
    ]);

    Course::create($request->all());
    return redirect()->route('admin.courses')->with('success', 'Kelas berhasil ditambah!');
    }

    // Halaman Form Edit
    public function editCourse($id)
    {
    $course = Course::findOrFail($id);
    return view('admin.courses_edit', compact('course'));
    }

    // Proses Update Kelas
    public function updateCourse(Request $request, $id)
    {
    $course = Course::findOrFail($id);
    $course->update($request->all());
    return redirect()->route('admin.courses')->with('success', 'Kelas berhasil diupdate!');
    }

    // Proses Hapus Kelas
    public function deleteCourse($id)
    {
    Course::findOrFail($id)->delete();
    return redirect()->route('admin.courses')->with('success', 'Kelas berhasil dihapus!');
    }
}
