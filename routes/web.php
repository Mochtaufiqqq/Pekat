<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\PetugasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
        Route::get('/tambahpetugas', [PetugasController::class,'add']);
        Route::post('/storepetugas', [PetugasController::class,'store']);
        Route::get('/editpetugas/{id_petugas}', [PetugasController::class,'edit']);
        Route::put('/updatepetugas/{id_petugas}', [PetugasController::class,'update']);
        Route::get('/detailpetugas/{id_petugas}', [PetugasController::class,'detail']);
        Route::delete('/deletepetugas/{id_petugas}', [PetugasController::class,'destroy']);
        
        // report
        // Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');
        Route::get('/pengaduan', [AdminController::class,'pengaduan']);
        Route::get('/detailpengaduan/{id_pengaduan}', [AdminController::class,'detailpengaduan']);
        Route::post('/tanggapan/createOrUpdate',[AdminController::class,'createOrUpdate']);

        // society
        Route::get('/masyarakat',[AdminController::class,'showsociety']);
        Route::get('/masyarakat/edit/{nik}',[AdminController::class,'editsociety']);
        Route::put('/masyarakat/update/{nik}',[AdminController::class,'updatesociety']);
        Route::get('/masyarakat/detail/{nik}',[AdminController::class,'detailsociety']);
        Route::delete('/masyarakat/delete/{nik}', [AdminController::class,'destroysociety']);
        Route::get('/masyarakat/sampah',[AdminController::class,'societytrash']);
        Route::put('/masyarakat/restore/{nik}',[AdminController::class,'restoresociety']);
    });
    

    Route::middleware(['isPetugas'])->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class,'index'])->name('dashboard.index');
        Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');
    });

});

/*
|--------------------------------------------------------------------------
| Society
|--------------------------------------------------------------------------
|
*/
Route::get('/', [UserController::class, 'index'])->name('pekat.index');

Route::middleware(['isMasyarakat'])->group(function() {

    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::post('/store', [UserController::class, 'storePengaduan'])->name('pekat.store');
    Route::get('/profile', [UserController::class, 'laporan'])->name('pekat.laporan');
    Route::get('/logout', [UserController::class, 'logout'])->name('pekat.logout');
    Route::put('/update/{nik}', [UserController::class, 'updatesociety']);
});

/*
|--------------------------------------------------------------------------
| Guest
|--------------------------------------------------------------------------
|
*/
Route::middleware(['guest'])->group(function() {    
    
    Route::post('/login/auth', [UserController::class, 'login'])->name('pekat.login');

    Route::get('/register', [UserController::class, 'formRegister'])->name('pekat.formRegister');
    Route::post('/register/auth', [UserController::class, 'register'])->name('pekat.register');
    Route::get('/loginadmin', [AdminController::class,'formLogin'])->name('admin.formLogin');
    Route::post('/login', [AdminController::class,'login'])->name('admin.login');
});

