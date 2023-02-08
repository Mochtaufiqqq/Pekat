<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Admin & Officer
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->group(function () {
  
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class,'index'])->name('dashboard.index');

        // officer
        Route::get('/petugas', [PetugasController::class,'show']);
        Route::get('/petugas/tambah', [PetugasController::class,'add']);
        Route::post('/petugas/store', [PetugasController::class,'store']);
        Route::get('/petugas/edit/{id_petugas}', [PetugasController::class,'edit']);
        Route::put('/petugas/update/{id_petugas}', [PetugasController::class,'update']);
        Route::get('/petugas/detail/{id_petugas}', [PetugasController::class,'detail']);
        Route::delete('/petugas/delete/{id_petugas}', [PetugasController::class,'destroy']);
        
        // report
        // Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');
        Route::get('/pengaduan', [AdminController::class,'pengaduan']);
        Route::get('/pengaduan/detail/{id_pengaduan}', [AdminController::class,'detailpengaduan']);
        Route::post('/tanggapan/createOrUpdate',[AdminController::class,'createOrUpdate']);
        Route::delete('/pengaduan/delete/{id_pengaduan}', [AdminController::class,'destroypengaduan']);
        Route::get('/sampah',[AdminController::class,'pengaduantrash']);
        Route::put('/sampah/restore/{id_pengaduan}',[AdminController::class,'restorepengaduan']);

        // society
        Route::get('/masyarakat',[AdminController::class,'showsociety']);
        Route::get('/masyarakat/edit/{nik}',[AdminController::class,'editsociety']);
        Route::put('/masyarakat/update/{nik}',[AdminController::class,'updatesociety']);
        Route::get('/masyarakat/detail/{nik}',[AdminController::class,'detailsociety']);
        Route::delete('/masyarakat/delete/{nik}', [AdminController::class,'destroysociety']);
        // Route::get('/masyarakat/sampah',[AdminController::class,'societytrash']);
        // Route::put('/masyarakat/restore/{nik}',[AdminController::class,'restoresociety']);
    });
    

    /// Route for officer
    Route::middleware(['isPetugas'])->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class,'index'])->name('dashboard.index');
        Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');
    });

});

/*
|--------------------------------------------------------------------------
| Is Society
|--------------------------------------------------------------------------
|
*/
Route::get('/', [UserController::class, 'index'])->name('pekat.index');

Route::middleware(['isMasyarakat'])->group(function() {

    Route::get('/home', [UserController::class, 'dashboard']);
    Route::post('/store', [UserController::class, 'storePengaduan'])->name('pekat.store');
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/pengaduan/me', [UserController::class, 'pengaduan'])->name('pekat.laporan');
    Route::get('/pengaduan/me/edit/{id_pengaduan}', [UserController::class, 'editpengaduan']);
    Route::put('/pengaduan/me/update/{id_pengaduan}', [UserController::class, 'updatepengaduan']);
    Route::delete('/pengaduan/me/delete/{id_pengaduan}', [UserController::class,'destroypengaduan']);
    Route::get('/logout', [UserController::class, 'logout'])->name('pekat.logout');
    Route::put('/update/{nik}', [UserController::class, 'updateinfopribadi']);
});

/*
|--------------------------------------------------------------------------
| Is Guest
|--------------------------------------------------------------------------
|
*/
Route::middleware(['guest'])->group(function() {    
    
    Route::post('/login/auth', [UserController::class, 'loginPost'])->name('pekat.login');
    Route::get('/login', [UserController::class, 'login']);

    Route::get('/register', [UserController::class, 'formRegister'])->name('pekat.formRegister');
    Route::post('/register/auth', [UserController::class, 'register'])->name('pekat.register');
    Route::get('/loginadmin', [AdminController::class,'formLogin'])->name('admin.formLogin');
    Route::post('/login', [AdminController::class,'login'])->name('admin.login');
    Route::get('/password/reset',[ForgotPasswordController::class,'showLinkRequestForm']);
    Route::post('/password/email',[ForgotPasswordController::class,'sendResetLinkEmail']);

});

