<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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

// home page
Route::get('/', function () {
    return view('welcome');
});

// dashboard after login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    // edit profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // update profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // delete profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // change password

    Route::middleware('role:admin')->group(function () {
        // Role routes
        // create role
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
        // store role
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');
        // edit role
        Route::get('/role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
        // update role
        Route::patch('/role/{role}', [RoleController::class, 'update'])->name('role.update');
        // delete role
        Route::delete('/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
    });
});


require __DIR__ . '/auth.php';
