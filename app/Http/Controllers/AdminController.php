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
        // Admin tetap bisa melihat & menghapus kursus (moderasi), tapi tidak menambah.
        $courses = Course::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.courses', compact('courses'));
    }

    public function transactions()
    {
        $payments = Payment::with(['enrollment.user', 'enrollment.course'])
                    ->latest()
                    ->paginate(10);
                
        return view('admin.transactions', compact('payments'));
    }

    public function users(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                // Perbaikan Bug: Pakai groups (where & orWhere di dalam kurung) 
                // agar filter pencarian tidak mengabaikan role atau sebaliknya.
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

    // --- FITUR CREATE SUDAH DIHAPUS ---

    public function editCourse($id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses_edit', compact('course'));
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        // Tetap pakai validasi agar tidak ada data kosong yang masuk
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $course->update($request->all());
        return redirect()->route('admin.courses')->with('success', 'Kelas berhasil diupdate!');
    }

    public function deleteCourse($id)
    {
        Course::findOrFail($id)->delete();
        return redirect()->route('admin.courses')->with('success', 'Kelas berhasil dihapus!');
    }
}