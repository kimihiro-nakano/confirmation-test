<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('/', [ContactController::class, 'index'])->name('index');

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'showRegister'])->name('register');
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/login', [UserController::class, 'showLogin'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
});


Route::middleware('auth')->group(function () {
    Route::get('/admin', [CategoryController::class, 'showAdmin'])->name('admin');
    Route::get('/admin/search', [CategoryController::class, 'search'])->name('admin.search');
    Route::get('/admin/reset', [CategoryController::class, 'reset'])->name('admin.reset');
    Route::post('/admin/export', [CategoryController::class, 'export'])->name('admin.export');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::delete('/admin/delete', [CategoryController::class, 'destroy'])->name('admin.destroy');
});
