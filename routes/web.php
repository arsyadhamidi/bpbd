<?php

use App\Http\Controllers\Admin\AdminBencanaController;
use App\Http\Controllers\Admin\AdminGaleriBencanaController;
use App\Http\Controllers\Admin\AdminLokasiController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Middleware\CekLevel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrasiController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Landing\LandingBencanaController;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Landing\LandingGaleriController;
use App\Http\Controllers\Landing\LandingKontakController;
use App\Http\Controllers\Landing\LandingTentangKamiController;

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

// Landing
Route::get('/', [LandingController::class,'index']);
Route::get('/bencana', [LandingBencanaController::class,'index'])->name('bencana.index');
Route::get('/tentang-kami', [LandingTentangKamiController::class,'index'])->name('tentang-kami.index');
Route::get('/galeri-bencana', [LandingGaleriController::class,'index'])->name('galeri-bencana.index');
Route::get('/galeri-bencana/show/{id}', [LandingGaleriController::class,'show'])->name('galeri-bencana.show');
Route::get('/kontak', [LandingKontakController::class,'index'])->name('kontak.index');

// Login
Route::get("/login", [LoginController::class, "index"])->name("login")->middleware('guest');
Route::post("/login/authenticate", [LoginController::class, "authenticate"])->name("login.authenticate");
Route::get("/login/logout", [LoginController::class, "logout"])->name("login.logout");

// Registrasi
Route::get("/registrasi", [RegistrasiController::class, "index"])->name('registrasi.index');
Route::post("/registrasi/store", [RegistrasiController::class, "store"])->name('registrasi.store');

Route::middleware(['auth'])->group(
    function () {

        Route::get('/dashboard', [DashboardController::class, 'index']);

        // Setting
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::post('/setting/updateprofile', [SettingController::class, 'updateprofile'])->name('setting.updateprofile');
        Route::post('/setting/updateusername', [SettingController::class, 'updateusername'])->name('setting.updateusername');
        Route::post('/setting/updatepassword', [SettingController::class, 'updatepassword'])->name('setting.updatepassword');
        Route::post('/setting/updategambar', [SettingController::class, 'updategambar'])->name('setting.updategambar');
        Route::post('/setting/deletegambar', [SettingController::class, 'deletegambar'])->name('setting.deletegambar');


        // Admin
        Route::group(['middleware' => [CekLevel::class . ':Admin']], function () {

            // Galeri
            Route::get('/data-galeri', [AdminGaleriBencanaController::class,'index'])->name('data-galeri.index');
            Route::get('/data-galeri/create', [AdminGaleriBencanaController::class,'create'])->name('data-galeri.create');
            Route::post('/data-galeri/store', [AdminGaleriBencanaController::class,'store'])->name('data-galeri.store');
            Route::get('/data-galeri/edit/{id}', [AdminGaleriBencanaController::class,'edit'])->name('data-galeri.edit');
            Route::post('/data-galeri/update/{id}', [AdminGaleriBencanaController::class,'update'])->name('data-galeri.update');
            Route::post('/data-galeri/destroy/{id}', [AdminGaleriBencanaController::class,'destroy'])->name('data-galeri.destroy');

            // Bencana
            Route::get('/data-bencana', [AdminBencanaController::class,'index'])->name('data-bencana.index');
            Route::get('/data-bencana/create', [AdminBencanaController::class,'create'])->name('data-bencana.create');
            Route::post('/data-bencana/store', [AdminBencanaController::class,'store'])->name('data-bencana.store');
            Route::get('/data-bencana/edit/{id}', [AdminBencanaController::class,'edit'])->name('data-bencana.edit');
            Route::post('/data-bencana/update/{id}', [AdminBencanaController::class,'update'])->name('data-bencana.update');
            Route::post('/data-bencana/destroy/{id}', [AdminBencanaController::class,'destroy'])->name('data-bencana.destroy');

            // Lokasi
            Route::get('/data-lokasi', [AdminLokasiController::class,'index'])->name('data-lokasi.index');
            Route::get('/data-lokasi/create', [AdminLokasiController::class,'create'])->name('data-lokasi.create');
            Route::post('/data-lokasi/store', [AdminLokasiController::class,'store'])->name('data-lokasi.store');
            Route::get('/data-lokasi/edit/{id}', [AdminLokasiController::class,'edit'])->name('data-lokasi.edit');
            Route::post('/data-lokasi/update/{id}', [AdminLokasiController::class,'update'])->name('data-lokasi.update');
            Route::post('/data-lokasi/destroy/{id}', [AdminLokasiController::class,'destroy'])->name('data-lokasi.destroy');

            // User
            Route::get('/data-user', [AdminUsersController::class,'index'])->name('data-user.index');
            Route::get('/data-user/create', [AdminUsersController::class,'create'])->name('data-user.create');
            Route::post('/data-user/store', [AdminUsersController::class,'store'])->name('data-user.store');
            Route::get('/data-user/edit/{id}', [AdminUsersController::class,'edit'])->name('data-user.edit');
            Route::post('/data-user/update/{id}', [AdminUsersController::class,'update'])->name('data-user.update');
            Route::post('/data-user/destroy/{id}', [AdminUsersController::class,'destroy'])->name('data-user.destroy');
        });
    }
);
