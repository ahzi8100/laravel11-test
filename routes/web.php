<?php

use App\Models\User;
use App\Mail\LoginMail;
use Illuminate\Http\Request;
use App\Jobs\ProcessLoginMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CommentController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route::get('/', function () {
//     return view('welcome');
// });

// Admin
Route::prefix('manage')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}/detail', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::patch('/blogs/{id}/update', [BlogController::class, 'update'])->name('blogs.update');
    Route::get('/blogs/{id}/delete', [BlogController::class, 'delete'])->name('blogs.delete');
    Route::get('/blogs/trash', [BlogController::class, 'trash'])->name('blogs.trash');
    Route::get('/blogs/{id}/restore', [BlogController::class, 'restore'])->name('blogs.restore');

    Route::get('/blogs/comment/latest', [BlogController::class, 'latest'])->name('blogs.comments.latest');
    Route::get('/blogs/phone', [BlogController::class, 'phone'])->name('blogs.phone');

    Route::middleware('admin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/phones', [PhoneController::class, 'index'])->name('phones.index');
        Route::post('/comment/{blog}', [CommentController::class, 'store'])->name('comment.store');
        Route::get('/comment', [CommentController::class, 'index'])->name('comment.index');
        Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
        Route::get('/users/comments', [UserController::class, 'comments']);
        Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'createUser'])->name('register.user');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/manage/blogs');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/', [BlogController::class, 'homepage'])->name('blogs.homepage');
Route::get('/blogs/{id}', [BlogController::class, 'detail'])->name('blogs.detail');

Route::get('/upload', function () {
    return Storage::disk('public')->put('example1.txt', 'Contents');
});

Route::get('/file-uploaded', function () {
    echo asset('storage/example1.txt');
});

Route::get('/send-email', function (Request $request) {
    $users = User::limit(10)->get();

    foreach ($users as $user) {
        ProcessLoginMail::dispatch(
            $user,
            $request->ip(),
            now()->toDateTimeString(),
            $request->userAgent()
        )->onQueue('send-login-notification');
    }

    return 'Sending Email Completed';
});




// Route::get('/hello', function () {
//     return 'Halo dari Laravel 11!';
// });

// Route::get('/artikel', function () {
//     return 'Ini adalah halaman artikel!';
// });

// Route::get('/blog', function () {
//     return view('blog');
// });

// Route::get('/blog', function () {
//     return view('blog', ['data' => 'blog 1', 'title' => 'Blog Laravel 11']);
// });

// Route::get('/blog', function () {
//     $data = 'blog 1';
//     $title = 'Blog Laravel 11';
//     return view('blog', ['data' => $data, 'title' => $title]);
// });

// Route::view('/tentang', 'about');

// Route::view('/blog', 'blog', ['data' => 'blog 1', 'title' => 'Blog Laravel 11']);


// Route::get('/hitung', function () {
//     $a = 4;
//     $b = 6;
//     return "Hasil: " . ($a + $b);
// });

// Route::get('/produk/{id}', function ($id) {
//     return "Ini halaman informasi detail untuk Produk ID: " . $id;
// });

// Route::get('/user/{nama?}', function ($nama = 'Tamu') {
//     return "Halo, $nama!";
// });

// Route::get('/profil', function () {
//     return 'Ini halaman profil';
// })->name('profil');

// Route::get('/ke-profil', function () {
//     return redirect()->route('profil');
// });

// Route::redirect('/beranda', '/hitung');

// Route::get('/blog', [BlogController::class, 'index']);


// Route::prefix('admin')->group(function () {
//     Route::get('/dashboard', function () {
//         return 'Admin Dashboard';
//     });
//     Route::get('/profil', function () {
//         return 'Ini halaman profil';
//     })->name('profil');
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return 'Dashboard User Terautentikasi';
//     });
// });

// Route::resource('post', PostController::class);
