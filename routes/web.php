<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/lang-ar', function () {
    session()->put('lang', 'ar');
    return back();
});
Route::get('/lang-en', function () {
    session()->put('lang', 'en');
    return back();
});

require __DIR__ . '/auth.php';

Route::get('/explore', [PostController::class, 'explore'])->name('explore')->middleware('lang');
Route::get('/{user:username}', [UserController::class, 'index'])->name('user_profile');
Route::get('/{user:username}/edit', [UserController::class, 'edit'])->middleware(['lang', 'auth'])->name('edit_profile');
Route::patch('/{user:username}/update', [UserController::class, 'update'])->middleware(['lang', 'auth'])->name('update_profile');

Route::controller(PostController::class)->middleware(['lang', 'auth'])->group(function () {
    Route::get('/', 'index')->name('home_page');
    Route::get('/p/create',  'create')->name('create_post');
    Route::post('/p/create', 'store')->name('store_post');
    Route::get('/p/{post:slug}', 'show')->name('show_post');
    Route::get('/p/{post:slug}/edit', 'edit')->name('edit_post');
    Route::post('/p/{post:slug}/comment', 'store')->name('store_comment');
    Route::patch('/p/{post:slug}/update',  'update')->name('update_post');
    Route::delete('/p/{post:slug}/delete', 'destroy')->name('delete_post');
});

Route::get('/p/{post:slug}/like', action: LikeController::class)->middleware(['lang', 'auth']);
Route::post('/p/{post:slug}/comment', [CommentController::class, 'store'])->name('store_comment');
Route::get('/{user:username}/follow', [UserController::class, 'follow'])->middleware(['lang', 'auth'])->name('follow_user');
Route::get('/{user:username}/unfollow', [UserController::class, 'unfollow'])->middleware(['lang', 'auth'])->name('unfollow_user');
// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['lang', 'auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
