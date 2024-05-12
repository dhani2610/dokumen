<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\JenisDokumenController;
use App\Http\Controllers\LogActionController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
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
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::post('/register', [RegisterController::class, 'store']);
Route::get('/register-user', [RegisterController::class, 'create']);


Route::group(['middleware' => 'auth'], function () {

	Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

	Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');
	Route::post('/update-setting', [InformasiController::class, 'update'])->name('update-setting');
	Route::post('/upload-image', [InformasiController::class, 'imageStore'])->name('upload-image');

	Route::get('/jenis-dokumen', [JenisDokumenController::class, 'index'])->name('jenis-dokumen');
	Route::post('/tambah-jenis-dokumen', [JenisDokumenController::class, 'store'])->name('tambah-jenis-dokumen');
	Route::post('/update-jenis-dokumen/{id}', [JenisDokumenController::class, 'update'])->name('update-jenis-dokumen');
	Route::get('/delete-jenis-dokumen/{id}', [JenisDokumenController::class, 'destroy'])->name('delete-jenis-dokumen');

	Route::post('/updateStatus/{id}', [DocumentController::class, 'updateStatus'])->name('updateStatus');
	Route::get('/waiting-approve-dokumen', [DocumentController::class, 'waitingApprove'])->name('waiting-approve-dokumen');
	Route::get('/dokumen', [DocumentController::class, 'index'])->name('dokumen');
	Route::post('/tambah-dokumen', [DocumentController::class, 'store'])->name('tambah-dokumen');
	Route::post('/update-dokumen/{id}', [DocumentController::class, 'update'])->name('update-dokumen');
	Route::get('/delete-dokumen/{id}', [DocumentController::class, 'destroy'])->name('delete-dokumen');
	Route::get('/laporan', [DocumentController::class, 'export_excel'])->name('laporan');
	
    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-management', [InfoUserController::class, 'userManagement'])->name('user-management');
	Route::post('/tambah-user', [InfoUserController::class, 'tambahUser'])->name('tambah-user');
	Route::post('/update-user/{id}', [InfoUserController::class, 'updateUser'])->name('update-user');
	Route::get('/delete-user/{id}', [InfoUserController::class, 'deleteUser'])->name('delete-user');
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);


	// PROGRAM STUDI 
	Route::get('/program-studi', [ProgramStudiController::class, 'index'])->name('program-studi');
	Route::post('/tambah-program-studi', [ProgramStudiController::class, 'store'])->name('tambah-program-studi');
	Route::post('/update-program-studi/{id}', [ProgramStudiController::class, 'update'])->name('update-program-studi');
	Route::get('/delete-program-studi/{id}', [ProgramStudiController::class, 'destroy'])->name('delete-program-studi');

	// FAKULTAS 
	Route::get('/fakultas', [FakultasController::class, 'index'])->name('fakultas');
	Route::post('/tambah-fakultas', [FakultasController::class, 'store'])->name('tambah-fakultas');
	Route::post('/update-fakultas/{id}', [FakultasController::class, 'update'])->name('update-fakultas');
	Route::get('/delete-fakultas/{id}', [FakultasController::class, 'destroy'])->name('delete-fakultas');
	
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');


	Route::post('/password-update', [ResetController::class, 'changePassword'])->name('password-update');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/login-post', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');