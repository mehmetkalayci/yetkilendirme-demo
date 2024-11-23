<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Auth;

// Oturum açma sayfası
Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');




// Kullanıcı oluşturma sayfası
Route::get('users/create', [UsersController::class, 'create'])->name('users.create');

// Kullanıcı oluşturma işlemi
Route::post('users', [UsersController::class, 'store'])->name('users.store');

// Kullanıcıları listeleme
Route::get('users', [UsersController::class, 'index'])->name('users.index');

// Kullanıcı düzenleme sayfası
Route::get('users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');

// Kullanıcı güncelleme işlemi
Route::put('users/{user}', [UsersController::class, 'update'])->name('users.update');

// Kullanıcı silme işlemi
Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');

// Rolleri görüntüle ve oluştur
Route::resource('roles', RolesController::class);

// İzinleri görüntüle ve oluştur
Route::resource('permissions', PermissionsController::class);

// Postlar için route'lar
Route::resource('posts', PostsController::class);

// Raporlar için route'lar
Route::resource('reports', ReportsController::class);

// Admin paneli için index sayfası
Route::get('/', function () {
    return view('index');
})->name('admin.index');

Route::post('roles/{role}/permissions', [RolesController::class, 'updatePermissions'])->name('roles.permissions');

