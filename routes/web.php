<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Api\PostExportController;
use App\Http\Controllers\UserManagementController;
use App\Models\UserIsActive;

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
Route::get('/show/{id}', [PostController::class, 'show'])->name('posts.show')
    ->middleware('log.requests');

Route::post('/register', [AuthController::class, 'registerUser'])
    ->name('registerUser');
Route::post('/login', [AuthController::class, 'loginUser'])
    ->name('loginUser');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgotpassword', [AuthController::class, 'forgotpw'])->name('forgotpw');
Route::post('/resetpw', [AuthController::class, 'resetpw'])->name('resetpw');

Route::get('lifecycle-test', function(){
    return response()->json([
        "Php version: " => phpversion(),
        "Current time: " => now()->toDateTimeString()
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/store', [PostController::class, 'store'])->name('posts.store');
    Route::post('/comment/{id}', [PostController::class, 'comment'])->name('posts.comment');
    Route::get('/profile', [PostController::class, 'profile'])->name('profile.show');
    Route::get('/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/update/{post:slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('posts.delete');
    Route::patch('/submit/{post}', [PostController::class, 'submit'])->name('posts.submit');
});

Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::patch('/publish/{post}', [PostController::class, 'publish'])->name('posts.publish');
    Route::patch('/reject/{post}', [PostController::class, 'reject'])->name('posts.reject');
    Route::get('/manageusers', function() {
        $users = User::paginate(10);
        return view('manageusers', compact('users'));
    })->name('users.index');
    Route::patch('/manageusers/{user}', [UserManagementController::class, 'toggle'])->name('users.toggle');
});
Route::middleware(['auth', 'can:manage-permissions'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/users', [App\Http\Controllers\Admin\PermissionController::class, 'users'])
            ->name('users.index');

        Route::get('/users/{user}/permissions', [App\Http\Controllers\Admin\PermissionController::class, 'edit'])
            ->name('users.permissions.edit');
        
        Route::patch('/users/{user}/permissions', [App\Http\Controllers\Admin\PermissionController::class, 'update'])
            ->name('users.permissions.update');
});

Route::get('/userpermission', function() {
    $users = User::all();
    return view('userpermission', compact('users'));
});