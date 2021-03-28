<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//Login
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/proses_login', [App\Http\Controllers\AuthController::class, 'proses_login'])->name('proses_login');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Auth::routes(['verify' => true]);

//Admin
Route::group(['middleware' => ['auth','CheckRole:0']], function(){
    //View Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
    //View Artikel
    Route::get('/artikel', [App\Http\Controllers\Admin\ArtikelController::class, 'index'])->name('artikel');
    Route::post('/artikel/create', [App\Http\Controllers\Admin\ArtikelController::class, 'create'])->name('artikel_create');
    Route::get('/artikel/delete/{id}', [App\Http\Controllers\Admin\ArtikelController::class, 'delete'])->name('artikel_delete');
        //View Update Artikel
        Route::get('/artikel/update/{id}', [App\Http\Controllers\Admin\ArtikelController::class, 'update'])->name('artikel_update');
        Route::post('/artikel/aksi_update/{id}', [App\Http\Controllers\Admin\ArtikelController::class, 'aksi_update'])->name('aksi_update');

    //View User
    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
});

//View User
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('welcome');
});