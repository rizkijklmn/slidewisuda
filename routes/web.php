<?php

use App\Http\Controllers\DualSlideshowController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\FrameController;
use App\Http\Controllers\GraduateController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/slideshow/{session?}', 'App\Http\Controllers\SlideshowController@index');
// Route::get('/slideshow/{index}', 'App\Http\Controllers\SlideshowController@index');

// Pemanggilan 2 Jalur (Controller Baru tanpa mengganggu slideshow reguler)
Route::get('/jalur/{block}/{session?}', [DualSlideshowController::class, 'block'])->name('slideshow.block');
Route::get('/slideshow2/{block}/{session?}', [DualSlideshowController::class, 'block']);
Route::get('/dual/{session?}', [DualSlideshowController::class, 'dual'])->name('slideshow.dual');
Route::get('/slideshow-dual/{session?}', [DualSlideshowController::class, 'dual']);

Route::get('/frame/{session?}', 'App\Http\Controllers\FrameController@index');

Route::get('/predikat', [FrameController::class, 'predikat'])->name('predikat');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('graduates', GraduateController::class);
    Route::resource('faculties', FacultyController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
