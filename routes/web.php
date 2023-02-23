<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OthersController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ForgotPasswordAdminController;
/*
|--------------------------------------------------------------------------
| Admin & Officer
|--------------------------------------------------------------------------
|
*/
Route::prefix('admin')->group(function () {
  
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/', [OthersController::class,'index'])->name('dashboard.index');

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
        Route::delete('/sampah/hapus/{id_pengaduan}',[AdminController::class,'forcedeletepengaduan']);

        // society
        Route::get('/masyarakat',[AdminController::class,'showsociety']);
        Route::get('/masyarakat/edit/{nik}',[AdminController::class,'editsociety']);
        Route::put('/masyarakat/update/{nik}',[AdminController::class,'updatesociety']);
        Route::get('/masyarakat/detail/{nik}',[AdminController::class,'detailsociety']);
        Route::delete('/masyarakat/delete/{nik}', [AdminController::class,'destroysociety']);
        // Route::get('/masyarakat/sampah',[AdminController::class,'societytrash']);
        // Route::put('/masyarakat/restore/{nik}',[AdminController::class,'restoresociety']);

        // profile
        Route::get('/profile/me',[AdminController::class,'profile']);
        Route::put('/profile/me/update/{id_petugas}',[AdminController::class,'updateprofile']);
        Route::put('/profile/me/update/password/{id_petugas}',[AdminController::class,'changePwPost']);

        //report
        Route::get('/laporan',[AdminController::class,'report']);
        Route::post('/laporan/getreport',[AdminController::class,'getReport']);
        Route::get('/laporan/pdf/{from}/{to}',[AdminController::class,'reportPdf'])->name('laporan.cetak');
        Route::get('/petugas/printpdf',[PetugasController::class,'printpdf']);
        Route::get('/masyarakat/printpdf',[UserController::class,'printpdf']);
    });
    

    /// Route for officer
    Route::middleware(['isPetugas'])->group(function () {
        Route::get('/dashboard', [OthersController::class,'index'])->name('dashboard.index');
        Route::get('/logout', [AdminController::class,'logout'])->name('admin.logout');
        Route::get('/pengaduan', [AdminController::class,'pengaduan']);
        Route::get('/pengaduan/detail/{id_pengaduan}', [AdminController::class,'detailpengaduan']);
        Route::post('/tanggapan/createOrUpdate',[AdminController::class,'createOrUpdate']);
        Route::delete('/pengaduan/delete/{id_pengaduan}', [AdminController::class,'destroypengaduan']);
    });

});

/*
|--------------------------------------------------------------------------
| Is Society
|--------------------------------------------------------------------------
|
*/


Route::middleware(['isMasyarakat'])->group(function() {

    Route::get('/home', [UserController::class, 'dashboard']);
    Route::post('/store', [UserController::class, 'storePengaduan'])->name('pekat.store');
    Route::get('/profile', [UserController::class, 'profile']);
    // report
    Route::get('/pengaduan/me', [UserController::class, 'pengaduan'])->name('pekat.laporan');
    Route::get('/pengaduan/me/edit/{id_pengaduan}', [UserController::class, 'editpengaduan']);
    Route::put('/pengaduan/me/update/{id_pengaduan}', [UserController::class, 'updatepengaduan']);
    Route::delete('/pengaduan/me/delete/{id_pengaduan}', [UserController::class,'destroypengaduan']);
    
    Route::get('/logout', [UserController::class, 'logout'])->name('pekat.logout');
    // update profile
    Route::put('/update/{nik}', [UserController::class, 'updateinfopribadi']);
    Route::put('/update/publik/{nik}', [UserController::class, 'updateInfoPublic']);
    Route::get('/ubah/password',[UserController::class,'changepassword']);
    Route::put('/ubah/password/post/{nik}',[UserController::class,'changePwPost']);
});

/*
|--------------------------------------------------------------------------
| Is Guest
|--------------------------------------------------------------------------
|
*/
Route::middleware(['guest'])->group(function() {    
    
    // auth
    Route::get('/', [UserController::class, 'index'])->name('pekat.index');
    Route::post('/login/auth', [UserController::class, 'loginPost'])->name('pekat.login');
    Route::get('/login', [UserController::class, 'login']);

    Route::get('/register', [UserController::class, 'formRegister'])->name('pekat.formRegister');
    Route::post('/register/auth', [UserController::class, 'register'])->name('pekat.register');
    Route::get('/admin/login', [AdminController::class,'formLogin'])->name('admin.formLogin');
    Route::post('/login', [AdminController::class,'login'])->name('admin.login');

    // forgot password society
    Route::get('/password/reset/',[ForgotPasswordController::class,'forgotPassword']);
    Route::post('/password/email',[ForgotPasswordController::class,'mailReset']);
    Route::get('/password/reset/email/{token}',[ForgotPasswordController::class,'resetPassword']);
    Route::post('/password/change',[ForgotPasswordController::class,'changePassword']);
    // end

    // forgot password officer
    Route::get('/admin/password/reset/',[ForgotPasswordAdminController::class,'forgotPassword']);
    Route::post('/admin/password/email',[ForgotPasswordAdminController::class,'mailReset']);
    Route::get('/admin/password/reset/email/{token}',[ForgotPasswordAdminController::class,'resetPassword']);
    Route::post('/admin/password/change',[ForgotPasswordAdminController::class,'changePassword']);
    // end
    Route::get('/help',[OthersController::class,'help']);
    Route::get('/contact-us', [OthersController::class, 'showForm']);
    Route::post('/contact-us', [OthersController::class, 'sendEmail']);
    
});

