<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostExportController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', [PostController::class, 'index'])->name('home');


// Route::get('/register', [AuthController::class, 'register'])->name('register');
// Route::get('/login', [AuthController::class, 'login'])->name('login');
// Route::get('/show/{id}', [PostController::class, 'show'])->name('show');

// Route::post('/register', [AuthController::class, 'registerUser'])->name('registerUser');
// Route::post('/login', [AuthController::class, 'loginUser'])->name('loginUser');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::middleware('auth')->group(function () {
//     Route::get('/create', [PostController::class, 'create'])->name('create');
//     Route::post('/store', [PostController::class, 'store'])->name('store');
//     Route::post('/comment/{id}', [PostController::class, 'comment'])->name('comment');
//     Route::get('/profile', [PostController::class, 'profile'])->name('profile');
//     Route::post('/edit/{id}', [PostController::class, 'edit'])->name('edit');
//     Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
// });

// Route::middleware('can:manage-permissions')->prefix('admin')->name('admin.')->group(function () {
//     Route::get('/permissions',         [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.index');
//     Route::post('/permissions/{role}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('permissions.update');



Route::get('/', [PostController::class, 'index'])->name('home');


Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/show/{id}', [PostController::class, 'show'])->name('show');

Route::post('/register', [AuthController::class, 'registerUser'])->name('registerUser');
Route::post('/login', [AuthController::class, 'loginUser'])->name('loginUser');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgotpassword', [AuthController::class, 'forgotpw'])->name('forgotpw');
Route::post('/resetpw', [AuthController::class, 'resetpw'])->name('resetpw');


Route::middleware('auth')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');
    Route::post('/comment/{id}', [PostController::class, 'comment'])->name('comment');
    Route::get('/profile', [PostController::class, 'profile'])->name('profile');
    Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
    Route::put('/update/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('delete');
    Route::patch('/publish/{post}', [PostController::class, 'publish'])->name('publish');
    Route::patch('/submit/{post}', [PostController::class, 'submit'])->name('submit');
    Route::patch('/reject/{post}', [PostController::class, 'reject'])->name('reject');
});

Route::middleware('can:manage-permissions')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/permissions',         [App\Http\Controllers\Admin\PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions/{role}', [App\Http\Controllers\Admin\PermissionController::class, 'update'])->name('permissions.update');
});
