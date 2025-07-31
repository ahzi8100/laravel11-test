<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}/detail', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::patch('/blogs/{id}/update', [BlogController::class, 'update'])->name('blogs.update');
    Route::get('/blogs/{id}/delete', [BlogController::class, 'delete'])->name('blogs.delete');
    Route::get('/blogs/trash', [BlogController::class, 'trash'])->name('blogs.trash');
    Route::get('/blogs/{id}/restore', [BlogController::class, 'restore'])->name('blogs.restore');

    Route::post('/comment/{blog}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/comment', [CommentController::class, 'index'])->name('comment.index');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::get('/blogs/comment/latest', [BlogController::class, 'latest'])->name('blogs.comments.latest');
    Route::get('/blogs/phone', [BlogController::class, 'phone'])->name('blogs.phone');
    Route::get('/users/comments', [UserController::class, 'comments']);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/phones', [PhoneController::class, 'index'])->name('phones.index');

    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
});


Route::get('/blogs', [BlogController::class, 'homepage'])->name('blogs.homepage');
Route::get('/blogs/{id}', [BlogController::class, 'detail'])->name('blogs.detail');


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
