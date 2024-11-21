<?php

use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\BookingUser\BookingUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pic\PicController;
use App\Http\Controllers\Ruangan\RuanganController;
use App\Http\Controllers\RuanganUser\RuanganUserController;
use App\Http\Controllers\Tv\TvController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvScreenController;
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

// Route::get('/', function () {
    //     // Cek apakah user sudah login
    //     if (Auth::check()) {
        //         // Jika sudah login, arahkan ke halaman home atau halaman lain
        //         return redirect()->route('home');
        //     } else {
            //         // Jika belum login, arahkan ke halaman login
            //         // return redirect()->route('login');
            //         return redirect()->route('login');
            //     }
            // });
            
            


Route::get('/ruangan-user', [RuanganUserController::class, 'index'])->name('ruangan-user.index');



// routing booking user
Route::get('/check-booking', [BookingUserController::class, 'checkBooking']);
Route::post('/booking-user', [BookingUserController::class, 'store'])->name('booking-user.store');
Route::get('/booking-user-success', function () {
    return view('booking-user-kuitansi');
})->name('kuitansi');

Auth::routes();

// Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/preview-pdf', [HomeController::class, 'preview_pdf'])->name('home.preview');
Route::get('/home/download-pdf', [HomeController::class, 'download_pdf'])->name('home.download');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/pic', [PicController::class, 'index'])->name('pic.index');
Route::get('/pic-add', function () {
    return view('pic.pic-add');
})->name('pic.add');
Route::post('/pic-add', [PicController::class, 'store'])->name('pic.store');
Route::get('/pic/{id}/edit', [PicController::class, 'edit'])->name('pic.edit');
Route::put('/pic/{id}', [PicController::class, 'update'])->name('pic.update');
Route::delete('/pic/{id}', [PicController::class, 'destroy'])->name('pic.destroy');

Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
Route::get('/ruangan-add', [RuanganController::class, 'create'])->name('ruangan.add');
Route::post('/ruangan-add', [RuanganController::class, 'store'])->name('ruangan.store');
Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

Route::get('booking', [BookingController::class, 'index'])->name('booking.index');
Route::post('/booking/response/{id}', [BookingController::class, 'response'])->name('booking.response');
Route::get('/booking-add', [BookingController::class, 'create'])->name('booking.add');
Route::post('/booking-add', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
Route::put('/booking/{id}', [BookingController::class, 'update'])->name('booking.update');
Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');



Route::get('booking-user/{id?}', [BookingUserController::class, 'create'])->name('booking-user.create');
Route::post('booking-user', [BookingUserController::class, 'store'])->name('booking-user.store');
// routing Tv Screen
Route::get('/tv', [TvController::class, 'index'])->name('tv');

use App\Http\Controllers\LandingPageController;
Route::get('/', [LandingPageController::class, 'index']);

