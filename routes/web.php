<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [ResumeController::class, 'index']);
    Route::get('/home', [ResumeController::class, 'index'])->middleware('verified');

    Route::get('/edit/{id}', [ResumeController::class, 'edit']);
    Route::post('/submit/{id}', [ResumeController::class, 'submit']);

    Route::get('/delete/{id}', [ResumeController::class, 'delete']);

    Route::get('/show/{id}', [ResumeController::class, 'show']);

    Route::post('/create', [ResumeController::class, 'create']);
    Route::get('/new', [ResumeController::class, 'new']);


    Route::post('/contacts/submit', [ContactsController::class, 'submit']);
    Route::get('/contacts/edit', [ContactsController::class, 'edit']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
