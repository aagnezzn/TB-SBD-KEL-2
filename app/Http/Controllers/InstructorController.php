<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category; 
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Enrollment;
use App\Models\Payment;

class InstructorController extends Controller
{
    // 1. Menampilkan Halaman Login (Sesuai rute instructor.login)
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->role === 'instructor') {
            return redirect()->route('instructor.dashboard');
        }
        return view('instructor.login');
    }

    // 2. Dashboard Ringkasan (Sesuai rute instructor.dashboard)
    public function index()
{
    $user = Auth::user();
    
    // Ambil semua kursus milik instruktur ini
    $courses = Course::where('instructor_id', $user->id)->latest()->get();
    $courseIds = $courses->pluck('id');

    // Hitung statistik
    $totalCourses = $courses->count();
    $totalStudents = Enrollment::whereIn('course_id', $courseIds)->count();
    
    // FAKTA: Tambahkan logika hitung rating di bawah ini!
    $avgRating = \App\Models\Review::whereIn('course_id', $courseIds)->avg('rating') ?? 0;
    $avgRating = round($avgRating, 1);

    $totalRevenue = Payment::whereHas('enrollment', function($query) use ($courseIds) {
        $query->whereIn('course_id', $courseIds);
    })->sum('amount');

    // FAKTA: Kamu HARUS menambahkan 'avgRating' di dalam compact()
    return view('instructor.dashboard', compact('courses', 'totalCourses', 'totalStudents', 'totalRevenue', 'avgRating'));
}

    // 3. Daftar Kursus Saya (Sesuai rute instructor.courses.index)
    public function myCourses()
    {
        $courses = Course::where('instructor_id', Auth::id())->latest()->get();
        return view('instructor.courses.index', compact('courses'));
    }

    // 4. Form Buat Kursus (Sesuai rute instructor.courses.create & add)
    public function createCourse() {
        $categories = Category::all(); 
        return view('instructor.courses_create', compact('categories'));
    }

    // Alias untuk createCourse jika rute memanggil createNewCourse
    public function createNewCourse() {
        return $this->createCourse();
    }

    // 5. Simpan Kursus (Sesuai rute instructor.courses.store & save)
    public function storeCourse(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        // Generator Angka Acak untuk Cache Buster gambar LoremFlickr
        $angkaAcak = rand(1000, 9999);
        $imageUrl = "https://loremflickr.com/640/360/computer,office?lock={$angkaAcak}";

        Course::create([
            'instructor_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => $imageUrl,
            'status' => 'active',
        ]);

        // FIX LOGIKA UTAMAMU DI SINI:
        // Jika pembuatnya adalah Instruktur asli, langsung arahkan ke dashboard instruktur, jangan ke halaman upgrade role lagi!
        if (Auth::user()->role === 'instructor') {
            return redirect()->route('instructor.dashboard')->with('success', 'Kursus baru Anda berhasil diterbitkan!');
        }

        // Ini jembatan penahan cadangan jika pembuatnya ternyata siswa yang baru mengajukan upgrade rute
        return redirect()->route('instructor.confirmation');
    }

    // Alias untuk storeCourse
    public function storeNewCourse(Request $request) {
        return $this->storeCourse($request);
    }

    // 6. Manage & Edit (Sesuai rute manage & edit & update)
    public function manageCourse($id)
    {
        $course = Course::with('lessons')->where('instructor_id', Auth::id())->findOrFail($id);
        return view('instructor.courses.manage', compact('course'));
    }

    // Form Edit Kursus
    public function editCourse($id)
    {
        $course = Course::where('instructor_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('instructor.courses.edit', compact('course', 'categories'));
    }

    // Proses Perbaruan Data KursusSecara Aman
   public function updateCourse(Request $request, $id)
{
    // 1. Validasi
    $request->validate([
        'category_id' => 'required',
        'title' => 'required|string|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
    ]);

    // 2. Cari kursus
    $course = Course::where('instructor_id', Auth::id())->findOrFail($id);
    
    // 3. Update Kursus Utama
    $course->update([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
    ]);

    // 4. Update Materi (Lessons) - Inilah mesin pengubah judul materinya
    if ($request->has('lessons')) {
        foreach ($request->lessons as $lessonId => $lessonData) {
            Lesson::where('id', $lessonId)
                  ->where('course_id', $course->id)
                  ->update([
                      'title' => $lessonData['title'] // Mengambil input dari form tadi
                  ]);
        }
    }
    
    return redirect()->route('instructor.courses.index')->with('success', 'Perubahan berhasil disimpan!');
}

    // 7. Tambah Materi (Sesuai rute instructor.lessons.store)
    public function addLesson(Request $request, $id)
    {
        Lesson::create([
            'course_id' => $id,
            'title' => $request->title,
            'content' => $request->content,
            'duration' => $request->duration ?? 0,
        ]);
        return back()->with('success', 'Materi ditambahkan!');
    }

    // 8. Daftar Siswa (Sesuai rute instructor.students.index)
    public function myStudents()
    {
        $instructor = Auth::user();
        $courseIds = Course::where('instructor_id', $instructor->id)->pluck('id')->toArray();

        $students = \App\Models\User::where('role', 'student')
            ->whereHas('enrollments', function($query) use ($courseIds) {
                $query->whereIn('course_id', $courseIds);
            })
            ->with(['enrollments' => function($query) use ($courseIds) {
                $query->whereIn('course_id', $courseIds)->with('course');
            }])
            ->latest()
            ->get();

        return view('instructor.students.index', compact('students'));
    }

    // 9. Performa Statistik Grafik Pendapatan
    public function performance()
    {
        $instructorId = Auth::id();
        
        $courses = Course::where('instructor_id', $instructorId)->get();
        $courseIds = $courses->pluck('id');

        $totalEarnings = Payment::whereHas('enrollment', function($query) use ($courseIds) {
            $query->whereIn('course_id', $courseIds);
        })->sum('amount');

        $totalEnrollments = Enrollment::whereIn('course_id', $courseIds)->count();
        $averageRating = \App\Models\Review::whereIn('course_id', $courseIds)->avg('rating') ?? 0;

        $chartData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            
            $dayIncome = Payment::whereHas('enrollment', function($query) use ($courseIds) {
                $query->whereIn('course_id', $courseIds);
            })
            ->whereDate('created_at', $date->toDateString())
            ->sum('amount');

            $maxScale = 2000000; 
            $heightPercentage = $dayIncome > 0 ? min(($dayIncome / $maxScale) * 100, 100) : 0;

            $chartData[] = [
                'day'    => $date->isoFormat('ddd'), 
                'income' => $dayIncome,
                'height' => $heightPercentage
            ];
        }

        $data = [
            'total_earnings'    => $totalEarnings,
            'total_enrollments' => $totalEnrollments,
            'avg_rating'        => round($averageRating, 1),
        ];

        return view('instructor.performance', compact('data', 'chartData'));
    }

    // Merender halaman konfirmasi lama
    public function showConfirmation() {
        return view('instructor.confirmation');
    }

    // 10. Upgrade Role (Untuk Siswa jadi Instruktur)
    public function upgradeRole()
    {
        $user = Auth::user();
        $user->update(['role' => 'instructor']);
        return redirect()->route('instructor.dashboard')->with('success', 'Selamat! Anda sekarang adalah Instruktur.');
    }
}