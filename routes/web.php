<?php

use App\Http\Controllers\PinjamController;
use App\Http\Controllers\PenanggungjawabController;
use App\Http\Controllers\LantaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\profilcontroller;
use App\Http\Controllers\Select2SearchController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => ['admin']], function () {
// Route::get('/dashboard', function () {
//     return view('dashboard/dashboard');
// });
Route::get('/dashboard', '\App\Http\Controllers\DashboardController@index')->name('dashboard');
Route::get('/profil', function () {
    return view('profil');
});
//route resource

Route::group(['middleware' => ['user']], function () {
    Route::get('/pengguna/updpg', 'App\Http\Controllers\penggunaController@updpg')->name('pengguna.updpg');
Route::resource('/pengguna', \App\Http\Controllers\penggunaController::class);

Route::get('/pinjam/setuju/{id}', 'App\Http\Controllers\PinjamController@setuju');
Route::get('/pinjam/tolak/{id}', 'App\Http\Controllers\PinjamController@tolak');
});
// Route::post('pinjam/delete', 'App\Http\Controllers\PinjamController@destroy')->name('destroy');
Route::get('/pinjam/indexsetuju','App\Http\Controllers\PinjamController@setujuindex')->name('pinjam.setuju');
Route::get('/pinjam/indexproses','App\Http\Controllers\PinjamController@prosesindex')->name('pinjam.proses');
Route::get('/pinjam/indextolak','App\Http\Controllers\PinjamController@tolakindex')->name('pinjam.tolak');
Route::get('/pinjam/ajukan/{pinjam}', 'App\Http\Controllers\PinjamController@ajukan')->name('pinjam.ajukan',);
Route::put('/pinjam/ajukankembali/{id}', 'App\Http\Controllers\PinjamController@ajukankembali');

    
// Route::get('pinjam/delete/{id}',[PinjamController::class, 'delete'])->name('delete');
Route::resource('/pinjam', PinjamController::class);
Route::resource('/ruang', \App\Http\Controllers\RuangController::class);
Route::resource('/penanggungjawab', PenanggungjawabController::class);
Route::resource('/lantai', LantaiController::class);

Route::resource('/status', StatusController::class);



Route::get('/profil', [profilcontroller::class, 'index'])->name('profil');
Route::get('/gantipassword', [profilcontroller::class, 'gantipassword'])->name('gantiPassword');
Route::post('/update', [profilcontroller::class, 'update'])->name('update');
Route::post('/updatepw', [profilcontroller::class, 'updatepw'])->name('updatepw');
Route::get('home', [UserController::class, 'home'])->name('home');

});
Route::get('ajax-autocomplete-search2', 'App\Http\Controllers\PinjamController@select2search');
Route::get('ajax-autocomplete-search3', 'App\Http\Controllers\PinjamController@selectruang');
Route::get('search', [Select2SearchController::class,'index']);
Route::get('ajax-auto', 'App\Http\Controllers\penggunaController@select2Pengguna2');
Route::get('ajax-autocomplete-search5', 'App\Http\Controllers\PenanggungjawabController@select2Search');
Route::get('ajax-autocomplete-search4', 'App\Http\Controllers\penggunaController@select2Pengguna');

Route::get('ajax-autocomplete-search', [Select2SearchController::class,'selectSearch']);
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'register_action'])->name('register.action');
Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'login_action'])->name('login.action');
Route::get('password', [UserController::class, 'password'])->name('password');
Route::post('password', [UserController::class, 'password_action'])->name('password.action');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('admin', function () {return 'dashboard/dashboard';})->middleware('auth', 'admin');