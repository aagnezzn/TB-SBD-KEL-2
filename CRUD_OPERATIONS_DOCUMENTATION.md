# 📋 DOKUMENTASI OPERASI CRUD - TB SBD KEL-2

Dokumen ini berisi semua operasi **CREATE, READ, UPDATE, dan DELETE (CRUD)** dari seluruh project dengan format Eloquent ORM beserta ekuivalen SQL-nya.

---

## 🟦 1. CREATE OPERATIONS

### 1.1 Tambah Kursus (Course Create)
**File:** `InstructorController.php` - `storeCourse()`
```php
// dd($request->all());
try {
    Course::create([
        'instructor_id' => Auth::id(),
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'image_url' => "https://loremflickr.com/640/360/computer,office?lock={$angkaAcak}",
        'status' => 'active',
    ]);
    // INSERT INTO courses (instructor_id, category_id, title, description, price, image_url, status, created_at, updated_at) 
    // VALUES ($instructor_id, $category_id, $title, $description, $price, $image_url, 'active', NOW(), NOW());
    return redirect()->route('instructor.dashboard')->with('success', 'Kursus baru berhasil diterbitkan!');
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 1.2 Tambah Item ke Keranjang (Cart Add)
**File:** `CartController.php` - `addToCart()`
```php
// dd($course_id);
try {
    $exists = Cart::where('user_id', Auth::id())
                  ->where('course_id', $course_id)
                  ->exists();
    
    if (!$exists) {
        Cart::create([
            'user_id' => Auth::id(),
            'course_id' => $course_id,
        ]);
        // INSERT INTO carts (user_id, course_id, created_at, updated_at) 
        // VALUES ($user_id, $course_id, NOW(), NOW());
    }
    return redirect()->back()->with('success', 'Kursus berhasil ditambah!');
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 1.3 Buat Ulasan Kursus (Review Create)
**File:** `ReviewController.php` - `store()`
```php
// dd($request->all());
try {
    Review::create([
        'user_id' => Auth::id(),
        'course_id' => $id,
        'rating' => $request->rating,
        'comment' => $request->comment,
    ]);
    // INSERT INTO reviews (user_id, course_id, rating, comment, created_at, updated_at) 
    // VALUES ($user_id, $course_id, $rating, $comment, NOW(), NOW());
    return back()->with('success', 'Ulasan berhasil dikirim!');
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 1.4 Buat Pendaftaran Kursus (Enrollment Create)
**File:** `CheckoutController.php` - `store()`
```php
// dd($cartItems);
try {
    DB::transaction(function () use ($cartItems, $now, $request, &$lastPaymentId) {
        foreach ($cartItems as $item) {
            Enrollment::create([
                'user_id' => Auth::id(),
                'course_id' => $item->course_id, 
                'status' => 'active',
                'enrolled_at' => $now,
            ]);
            // INSERT INTO enrollments (user_id, course_id, status, enrolled_at, created_at, updated_at) 
            // VALUES ($user_id, $course_id, 'active', $now, NOW(), NOW());
        }
    });
    return redirect()->route('checkout.invoice', ['id' => $lastPaymentId]);
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 1.5 Buat Pembayaran (Payment Create)
**File:** `CheckoutController.php` - `store()`
```php
// dd($item->course_id);
try {
    $payment = Payment::create([
        'user_id' => Auth::id(),
        'course_id' => $item->course_id,
        'amount' => $item->course->price, 
        'payment_method' => $request->payment_method ?? 'Transfer Bank',
        'status' => 'success',
        'paid_at' => $now,
    ]);
    // INSERT INTO payments (user_id, course_id, amount, payment_method, status, paid_at, created_at, updated_at) 
    // VALUES ($user_id, $course_id, $amount, $payment_method, 'success', $now, NOW(), NOW());
    $lastPaymentId = $payment->id;
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 1.6 Tambah ke Wishlist (Wishlist Create)
**File:** `LearningController.php` - `addToWishlist()`
```php
// dd($id);
try {
    Wishlist::firstOrCreate([
        'user_id' => Auth::id(),
        'course_id' => $id
    ]);
    // INSERT INTO wishlists (user_id, course_id, created_at, updated_at) 
    // VALUES ($user_id, $id, NOW(), NOW()) 
    // ON DUPLICATE KEY UPDATE updated_at = NOW();
    return redirect()->back()->with('success', 'Berhasil ditambah ke wishlist');
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 1.7 Buat atau Update Profil User (UserProfile Create/Update)
**File:** `AccountController.php` - `index()`
```php
// dd($user->id);
try {
    if (!$user->profile) {
        $user->profile()->create([
            'first_name' => explode(' ', $user->name)[0] ?? 'User',
            'last_name' => explode(' ', $user->name)[1] ?? '',
        ]);
        // INSERT INTO user_profiles (user_id, first_name, last_name, created_at, updated_at) 
        // VALUES ($user_id, $first_name, $last_name, NOW(), NOW());
    }
    $user->load('profile');
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

---

## 🟩 2. READ OPERATIONS

### 2.1 Ambil Kursus per Kategori (Category Read)
**File:** `CourseController.php` - `filterByCategory()`
```php
// dd($idOrSlug);
try {
    if (is_numeric($idOrSlug)) {
        $category = Category::with('children.children')->findOrFail($idOrSlug);
        // SELECT * FROM categories WHERE id = $idOrSlug WITH CHILDREN RELATIONSHIP;
    } else {
        $decodedSlug = urldecode($idOrSlug);
        $category = Category::where('slug', $decodedSlug)
                            ->orWhere('slug', 'LIKE', '%' . $decodedSlug . '%')
                            ->with('children.children')
                            ->firstOrFail();
        // SELECT * FROM categories WHERE slug = $decodedSlug OR slug LIKE '%$decodedSlug%' WITH CHILDREN;
    }
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 2.2 Pencarian Kursus Global (Course Search)
**File:** `CourseController.php` - `search()`
```php
// dd($keyword);
try {
    $lowerKeyword = strtolower($keyword);
    $courses = Course::where(function($query) use ($lowerKeyword) {
                $query->whereRaw('LOWER(title) LIKE ?', ["%{$lowerKeyword}%"])
                      ->orWhereRaw('LOWER(description) LIKE ?', ["%{$lowerKeyword}%"]);
            })
            ->orWhereHas('user', function($query) use ($lowerKeyword) {
                $query->whereRaw('LOWER(name) LIKE ?', ["%{$lowerKeyword}%"]);
            })
            ->with(['user', 'category']) 
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->paginate(12);
    // SELECT * FROM courses 
    // WHERE LOWER(title) LIKE '%$keyword%' OR LOWER(description) LIKE '%$keyword%' 
    // OR user.name LIKE '%$keyword%' 
    // WITH AVG(reviews.rating) AND COUNT(reviews);
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 2.3 Ambil Item Keranjang (Cart Read)
**File:** `CourseController.php` - `index()` & `CartController.php` - `index()`
```php
// dd($user_id);
try {
    $cartItems = Cart::where('user_id', Auth::id())
                     ->with('course.user')
                     ->get();
    // SELECT carts.*, courses.*, users.* FROM carts 
    // LEFT JOIN courses ON carts.course_id = courses.id 
    // LEFT JOIN users ON courses.user_id = users.id 
    // WHERE carts.user_id = $user_id;
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 2.4 Ambil Detail Kursus (Course Detail Read)
**File:** `CourseController.php` - `show()` [assume ada]
```php
// dd($id);
try {
    $course = Course::with(['user', 'category', 'lessons', 'reviews'])
                    ->findOrFail($id);
    // SELECT * FROM courses 
    // LEFT JOIN users ON courses.instructor_id = users.id 
    // LEFT JOIN categories ON courses.category_id = categories.id 
    // LEFT JOIN lessons ON courses.id = lessons.course_id 
    // LEFT JOIN reviews ON courses.id = reviews.course_id 
    // WHERE courses.id = $id;
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 2.5 Ambil Dashboard Admin (Admin Read Multiple)
**File:** `AdminController.php` - `index()`
```php
// dd();
try {
    $totalPendapatan = Payment::where('status', 'success')->sum('amount');
    // SELECT SUM(amount) FROM payments WHERE status = 'success';
    
    $totalKelas = Course::count();
    // SELECT COUNT(*) FROM courses;
    
    $totalSiswa = User::where('role', 'student')->count();
    // SELECT COUNT(*) FROM users WHERE role = 'student';
    
    $transaksiTerbaru = Payment::with(['user', 'course'])->latest()->take(5)->get();
    // SELECT * FROM payments 
    // LEFT JOIN users ON payments.user_id = users.id 
    // LEFT JOIN courses ON payments.course_id = courses.id 
    // ORDER BY payments.created_at DESC LIMIT 5;
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 2.6 Ambil Daftar Kursus Admin (Admin Courses Paginate)
**File:** `AdminController.php` - `courses()`
```php
// dd();
try {
    $courses = Course::with('user')
                     ->orderBy('created_at', 'desc')
                     ->paginate(10);
    // SELECT courses.*, users.* FROM courses 
    // LEFT JOIN users ON courses.instructor_id = users.id 
    // ORDER BY courses.created_at DESC LIMIT 10 OFFSET 0;
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 2.7 Ambil Dashboard Instruktur (Instructor Dashboard)
**File:** `InstructorController.php` - `index()`
```php
// dd($user->id);
try {
    $courses = Course::where('instructor_id', $user->id)->latest()->get();
    // SELECT * FROM courses WHERE instructor_id = $instructor_id ORDER BY created_at DESC;
    
    $courseIds = $courses->pluck('id');
    $totalCourses = $courses->count();
    // COUNT($courses) = SELECT COUNT(*) FROM courses WHERE instructor_id = $instructor_id;
    
    $totalStudents = Enrollment::whereIn('course_id', $courseIds)->count();
    // SELECT COUNT(*) FROM enrollments WHERE course_id IN ($courseIds);
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 2.8 Ambil Profil Publik User (Public Profile Read)
**File:** `AccountController.php` - `showPublicProfile()`
```php
// dd($id);
try {
    $user = \App\Models\User::with('profile')->findOrFail($id);
    // SELECT users.*, user_profiles.* FROM users 
    // LEFT JOIN user_profiles ON users.id = user_profiles.user_id 
    // WHERE users.id = $id;
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 2.9 Ambil Riwayat Pembelian (Purchase History Read)
**File:** `LearningController.php` - `purchaseHistory()`
```php
// dd($user_id);
try {
    $payments = \App\Models\Payment::where('user_id', Auth::id())
                                   ->with('course')
                                   ->orderBy('paid_at', 'desc')
                                   ->get();
    // SELECT payments.*, courses.* FROM payments 
    // LEFT JOIN courses ON payments.course_id = courses.id 
    // WHERE payments.user_id = $user_id 
    // ORDER BY payments.paid_at DESC;
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 2.10 Ambil Kursus yang Dipelajari (Learning Courses Read)
**File:** `LearningController.php` - `index()`
```php
// dd($user->id);
try {
    if ($tab == 'wishlist') {    
        $courses = Wishlist::where('user_id', $user->id)
                            ->with('course.user')
                            ->get()
                            ->pluck('course');
        // SELECT courses.* FROM wishlists 
        // LEFT JOIN courses ON wishlists.course_id = courses.id 
        // WHERE wishlists.user_id = $user_id;
    } else {
        $courses = $user->courses()->with('user')->get();
        // SELECT courses.* FROM courses 
        // LEFT JOIN enrollments ON courses.id = enrollments.course_id 
        // WHERE enrollments.user_id = $user_id;
    }
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

---

## 🟨 3. UPDATE OPERATIONS

### 3.1 Update Data Kursus Admin (Course Update Admin)
**File:** `AdminController.php` - `updateCourse()`
```php
// dd($request->all());
try {
    $course = Course::findOrFail($id);
    // SELECT * FROM courses WHERE id = $id;
    
    $course->update([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
    ]);
    // UPDATE courses SET title = $title, description = $description, price = $price 
    // WHERE id = $id;
    
    return redirect()->route('admin.courses')->with('success', 'Kelas berhasil diupdate!');
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 3.2 Update Data Kursus Instruktur (Course Update Instructor)
**File:** `InstructorController.php` - `updateCourse()`
```php
// dd($request->all());
try {
    $course = Course::where('instructor_id', Auth::id())->findOrFail($id);
    // SELECT * FROM courses WHERE instructor_id = $instructor_id AND id = $id;
    
    $course->update([
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
    ]);
    // UPDATE courses SET category_id = $category_id, title = $title, 
    // description = $description, price = $price WHERE id = $id;
    
    if ($request->has('lessons')) {
        foreach ($request->lessons as $lessonId => $lessonData) {
            Lesson::where('id', $lessonId)
                  ->where('course_id', $course->id)
                  ->update(['title' => $lessonData['title']]);
            // UPDATE lessons SET title = $title WHERE id = $lessonId AND course_id = $course_id;
        }
    }
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 3.3 Update Profil User (Profile Update)
**File:** `AccountController.php` - `updateProfile()`
```php
// dd($request->all());
try {
    $user = Auth::user();
    $user->profile()->updateOrCreate(
        ['user_id' => $user->id],
        [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'headline' => $request->headline,
            'bio' => $request->bio,
            'website' => $request->website,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter,
        ]
    );
    // UPDATE user_profiles SET first_name = $first_name, last_name = $last_name, 
    // headline = $headline, bio = $bio, website = $website, facebook = $facebook, 
    // instagram = $instagram, twitter = $twitter 
    // WHERE user_id = $user_id;
    
    $user->name = $request->first_name . ' ' . $request->last_name;
    $user->save();
    // UPDATE users SET name = CONCAT($first_name, ' ', $last_name) WHERE id = $user_id;
    
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 3.4 Update Email User (Email Update)
**File:** `AccountController.php` - `updateEmail()`
```php
// dd($request->new_email);
try {
    $user = Auth::user();
    $user->email = $request->new_email;
    $user->save();
    // UPDATE users SET email = $new_email WHERE id = $user_id;
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 3.5 Update Password User (Password Update)
**File:** `AccountController.php` - `updatePassword()`
```php
// dd($request->password);
try {
    $user = Auth::user();
    $user->password = Hash::make($request->password);
    $user->save();
    // UPDATE users SET password = bcrypt($password) WHERE id = $user_id;
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 3.6 Update atau Buat Foto Profil (Photo Update/Create)
**File:** `AccountController.php` - `updatePhoto()`
```php
// dd($request->file('photo'));
try {
    $user = Auth::user();
    
    if ($request->hasFile('photo')) {
        if ($user->profile && $user->profile->photo) {
            unlink(public_path('storage/photos/' . $user->profile->photo));
            // DELETE FILE: storage/photos/{$old_photo};
        }
        
        $file = $request->file('photo');
        $fileName = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('storage/photos'), $fileName);
        
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            ['photo' => $fileName]
        );
        // UPDATE user_profiles SET photo = $fileName WHERE user_id = $user_id;
    }
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 3.7 Pindahkan dari Wishlist ke Cart (Move to Cart)
**File:** `LearningController.php` - `moveToCart()`
```php
// dd($id);
try {
    $userId = Auth::id();
    
    Cart::updateOrCreate([
        'user_id' => $userId,
        'course_id' => $id
    ]);
    // INSERT INTO carts (user_id, course_id) VALUES ($userId, $id) 
    // ON DUPLICATE KEY UPDATE updated_at = NOW();
    
    Wishlist::where('user_id', $userId)
            ->where('course_id', $id)
            ->delete();
    // DELETE FROM wishlists WHERE user_id = $userId AND course_id = $id;
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

---

## 🟥 4. DELETE OPERATIONS

### 4.1 Hapus Item dari Keranjang (Cart Delete)
**File:** `CartController.php` - `removeFromCart()`
```php
// dd($id);
try {
    $cartItem = Cart::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();
    // SELECT * FROM carts WHERE id = $id AND user_id = $user_id LIMIT 1;
    
    $cartItem->delete();
    // DELETE FROM carts WHERE id = $id;
    
    return redirect()->back()->with('success', 'Kursus berhasil dihapus dari keranjang.');
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 4.2 Hapus Kursus Admin (Course Delete)
**File:** `AdminController.php` - `deleteCourse()`
```php
// dd($id);
try {
    Course::findOrFail($id)->delete();
    // DELETE FROM courses WHERE id = $id;
    
    return redirect()->route('admin.courses')->with('success', 'Kelas berhasil dihapus!');
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 4.3 Hapus dari Wishlist (Wishlist Delete)
**File:** `LearningController.php` - `removeFromWishlist()`
```php
// dd($id);
try {
    Wishlist::where('user_id', Auth::id())
            ->where('course_id', $id)
            ->delete();
    // DELETE FROM wishlists WHERE user_id = $user_id AND course_id = $id;
    
    return redirect()->back()->with('success', 'Berhasil dihapus dari daftar keinginan.');
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 4.4 Hapus Foto Profil (Photo Delete)
**File:** `AccountController.php` - `deletePhoto()`
```php
// dd($user->id);
try {
    $user = Auth::user();
    
    if ($user->profile && $user->profile->photo) {
        if (Storage::disk('public')->exists('photos/' . $user->profile->photo)) {
            Storage::disk('public')->delete('photos/' . $user->profile->photo);
            // DELETE FILE: storage/photos/{$photo};
        }
        
        $user->profile()->update(['photo' => null]);
        // UPDATE user_profiles SET photo = NULL WHERE user_id = $user_id;
    }
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

### 4.5 Hapus Keranjang Setelah Checkout (Cart Clear After Checkout)
**File:** `CheckoutController.php` - `store()`
```php
// dd($user_id);
try {
    DB::transaction(function () use ($cartItems, $now, $request, &$lastPaymentId) {
        // ... [Create payments dan enrollments] ...
        
        Cart::where('user_id', Auth::id())->delete();
        // DELETE FROM carts WHERE user_id = $user_id;
    });
} catch (\Throwable $th) {
    return back()->with('error', $th->getMessage());
}
```

---

## 📊 RINGKASAN OPERASI CRUD

| Operasi | Model | Metode | Controller |
|---------|-------|--------|-----------|
| **CREATE** | Course | `storeCourse()` | InstructorController |
| **CREATE** | Cart | `addToCart()` | CartController |
| **CREATE** | Review | `store()` | ReviewController |
| **CREATE** | Enrollment | `store()` | CheckoutController |
| **CREATE** | Payment | `store()` | CheckoutController |
| **CREATE** | Wishlist | `addToWishlist()` | LearningController |
| **CREATE** | UserProfile | `index()` | AccountController |
| **READ** | Category | `filterByCategory()` | CourseController |
| **READ** | Course | `search()`, `index()` | CourseController, CartController |
| **READ** | Cart | `index()` | CartController |
| **READ** | User | `showPublicProfile()` | AccountController |
| **READ** | Payment | `index()` | AdminController |
| **READ** | Course | `courses()` | AdminController |
| **READ** | Enrollment | `index()` | InstructorController |
| **UPDATE** | Course | `updateCourse()` | AdminController, InstructorController |
| **UPDATE** | UserProfile | `updateProfile()` | AccountController |
| **UPDATE** | User | `updateEmail()`, `updatePassword()` | AccountController |
| **UPDATE** | Photo | `updatePhoto()` | AccountController |
| **DELETE** | Cart | `removeFromCart()` | CartController |
| **DELETE** | Course | `deleteCourse()` | AdminController |
| **DELETE** | Wishlist | `removeFromWishlist()` | LearningController |
| **DELETE** | Photo | `deletePhoto()` | AccountController |

---

## ✅ Catatan Penting

1. **Error Handling**: Semua operasi menggunakan `try-catch` untuk menangani exception
2. **Eager Loading**: Menggunakan `->with()` untuk optimasi query dan menghindari N+1 problem
3. **Database Transaction**: Menggunakan `DB::transaction()` untuk operasi multi-table yang harus konsisten
4. **Validasi Input**: Semua operasi melakukan validasi dengan `validate()` sebelum proses
5. **Authorization**: Beberapa operasi mengecek apakah user punya hak akses (contoh: instruktur hanya bisa update kursus miliknya)

---

*Dokumentasi ini dibuat pada: 20 Mei 2026*
