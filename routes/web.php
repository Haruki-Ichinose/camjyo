<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Hscode_2digitController;
use App\Http\Controllers\Hscode_6digitController;
use App\Http\Controllers\ExportabilityController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\DocumentController;

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
Route::post('Hscode_6digit/show', [Hscode_6digitController::class,'show'])->name('6digit.show');
Route::get('Hscode_6digit/access', [Hscode_6digitController::class,'access'])->name('6digit.access');

Route::get('exportability/edit',[ ExportabilityController::class,'edit'])->name('exportability.edit');
Route::resource('exportability', ExportabilityController::class)->except('edit');

Route::resource('document',DocumentController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/googledrive', [GoogleDriveController::class, 'googledriveForm'])->name('upload.form');
Route::post('/upload', [GoogleDriveController::class, 'upload'])->name('upload');
Route::get('/googledrive/files', [GoogleDriveController::class, 'listFiles'])->name('googledrive.files');
Route::get('/googledrive/download/{id}', [GoogleDriveController::class, 'downloadFile'])->name('googledrive.download');

require __DIR__.'/auth.php';