<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hscode_2digitController;
use App\Http\Controllers\Hscode_6digitController;
use App\Http\Controllers\FileUploadController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('Hscode_2digit/index', [Hscode_2digitController::class,'index'])->name('2digit.index');
Route::post('Hscode_6digit/index', [Hscode_6digitController::class,'index'])->name('6digit.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/upload', [FileUploadController::class, 'uploadForm'])->name('upload.form');
Route::post('/upload', [FileUploadController::class, 'upload'])->name('upload');

require __DIR__.'/auth.php';