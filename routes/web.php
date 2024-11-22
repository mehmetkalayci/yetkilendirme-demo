<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'permission:edit_posts'])->group(function () {
    Route::put('/post/{post}', [PostController::class, 'update']);
});

// Rolleri görüntüle ve oluştur
Route::resource('roles', RoleController::class);

// İzinleri görüntüle ve oluştur
Route::resource('permissions', PermissionController::class);

Route::post('roles/{role}/permissions', [RoleController::class, 'assignPermissions'])->name('roles.permissions');

// Kullanıcı oluşturma sayfası
Route::get('users/create', [UserController::class, 'create'])->name('users.create');

// Kullanıcı oluşturma işlemi
Route::post('users', [UserController::class, 'store'])->name('users.store');

// Kullanıcıları listeleme
Route::get('users', [UserController::class, 'index'])->name('users.index');

// Kullanıcı düzenleme sayfası
Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

// Kullanıcı güncelleme işlemi
Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');

// Kullanıcı silme işlemi
Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Postlar için route'lar
Route::resource('posts', PostController::class);
Route::middleware(['auth', 'permission:view_posts'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
});

// Raporlar için route'lar
Route::resource('reports', ReportController::class);

// Oturum açma sayfası
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

// Oturum açma işlemi
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);

// Oturum kapatma işlemi
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin paneli için index sayfası
Route::get('/admin', function () {
    return view('index');
})->name('admin.index');

