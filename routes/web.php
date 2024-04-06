<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $blogs = \App\Models\Blog::whereNotNull('published_at') // Filter published posts
        ->latest()
        ->paginate(5);
    return view('welcome', compact('blogs'));
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


//routes for blog
Route::middleware(['role:blogger'])->group(function () {
    Route::resource('user-blogs', BlogController::class)->except(['show']);

    Route::get('user-blogs/{user_blog}', [BlogController::class, 'show'])->name('user-blogs.show')->withoutMiddleware('role:blogger');
});

Route::post('/blog/comment/{user_blog}', [BlogController::class, 'comment'])->name('blog.comment');


//routes for admin
Route::middleware(['role:admin'])->group(function () {
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    Route::get('/admin-blogs', [AdminController::class, 'blogs'])->name('admin.blogs');
    Route::post('/admin-blogs/{blog}/publish', [AdminController::class, 'publish'])->name('admin.blogs.publish');
    Route::post('/admin-blogs/{blog}/unpublish', [AdminController::class, 'unpublish'])->name('admin.blogs.unpublish');
    Route::delete('/admin-blogs/{blog}', [AdminController::class, 'destroyBlog'])->name('admin.blogs.destroy');
});




