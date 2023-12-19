<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\UnitKerjaController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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
        return view('halaman_login');
    });
    Route::post('/actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
    Route::get('/logout/{id}', [LoginController::class, 'logout']);
    
    Route::group(['middleware'=>['auth']],function(){
        Route::get('/dashboard', [DashboardController::class, 'show']);
    Route::get('/profile', [LoginController::class, 'show']);
    Route::post('/profile/update/{id}', [LoginController::class, 'update']);
    
    Route::controller(LembagaController::class)->group(function (){
        Route::get('/lembaga','show');
        Route::post('/lembaga/update/{id}','update');
    });
    
    Route::controller(UnitKerjaController::class)->group(function (){
        Route::get('/unit-kerja','show');
        Route::post('/unit-kerja/create','create');
        Route::post('/unit-kerja/update/{id}','update');
        Route::get('/unit-kerja/delete/{id}','delete');
    });
    
    Route::controller(UserController::class)->group(function (){
        Route::get('/user','show');
        Route::post('/user/create','create');
        Route::post('/user/update/{id}','update');
        Route::get('/user/delete/{id}','delete');
    });
    
    Route::controller(SuratMasukController::class)->group(function (){
        Route::get('/surat-masuk','show');
        Route::post('/surat-masuk/create','create');
        Route::post('/surat-masuk/update/{id}','update');
        Route::get('/surat-masuk/delete/{id}','delete');
        Route::get('/surat-masuk/detail/{id}','detail');
        Route::post('/surat-masuk/disposisi/update/{id}','disposisi');
        Route::post('/surat-masuk/penyimpanan/update/{id}','penyimpanan');
        Route::post('/surat-masuk/file/update/{id}','update_file');
        Route::get('/surat-masuk/cetak_pdf','cetak_pdf_sm');
    });
    
    Route::controller(SuratKeluarController::class)->group(function (){
        Route::get('/surat-keluar','show');
        Route::post('/surat-keluar/create','create');
        Route::post('/surat-keluar/update/{id}','update');
        Route::get('/surat-keluar/delete/{id}','delete');
        Route::post('/surat-keluar/file/update/{id}','update_file');
        Route::get('/surat-keluar/cetak_pdf','cetak_pdf_sk');
    
    });
    
    Route::controller(ReportController::class)->group(function (){
        Route::get('/report-sm','showSm');
        Route::get('/report-sm/action','reportsm');
        Route::get('/report-sm/cetak_pdf','cetak_pdf_sm');
        Route::get('/report-sk','showSk');
        Route::get('/report-sk/action','reportsk');
        Route::get('/report-sk/cetak_pdf','cetak_pdf_sk');
    });
    });





