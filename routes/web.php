<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
Route::get('/post/{id}/edit', [PostController::class, 'edit']);
Route::post('/post/{id}/edit', [PostController::class, 'update']);

Route::get('/tag', [TagController::class, 'index'])->name('tag.index');


Route::middleware(['auth', 'is_admin:1'])->group(function () {
    Route::delete('/post', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/tag', [TagController::class, 'store'])->name('tag.store');
    Route::get('/tag/create', [TagController::class, 'create'])->name('tag.create');
    Route::get('/tag/{id}', [TagController::class, 'show'])->name('tag.show');
    Route::delete('/tag', [TagController::class, 'destroy'])->name('tag.destroy');
    Route::get('/tag/{id}/edit', [TagController::class, 'edit'])->name('tag.edit');
    Route::post('/tag/{id}/edit', [TagController::class, 'update'])->name('tag.update');

});

require __DIR__.'/auth.php';
