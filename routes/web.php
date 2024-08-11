<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

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

// Public route to the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Protected route to the dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // User profile management routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Book and category viewing routes for authenticated users
   // Book routes
   Route::resource('books', BookController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
   Route::resource('categories', CategoryController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
   Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');


});

// Include authentication routes (register, login, logout, etc.)
require __DIR__.'/auth.php';
