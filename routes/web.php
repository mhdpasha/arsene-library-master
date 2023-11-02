<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\PinjamController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChangePasswordController;

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

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

Route::group(['middleware' => 'auth'], function () {
	// Pustakawan
	Route::group(['middleware' => 'pustakawan'], function () {
		Route::resource('user', AnggotaController::class);
		Route::resource('buku', BukuController::class)->except([
			'create', 'edit'
		]);
	});
	// Anggota
	Route::resource('history', HistoryController::class);
	Route::resource('pinjam', PinjamController::class);
	Route::resource('buku', BukuController::class)->only('show');
	Route::controller(DashboardController::class)->group(function() {
		Route::get('/dashboard', 'index')->name('dashboard');
		Route::get('', function () {
			return redirect('dashboard');
		});
	});


	Route::controller(InfoUserController::class)->group(function() {
		Route::get('/user-profile', 'create');
		Route::post('/user-profile', 'store');
		Route::post('/user-profile/image', 'storeImage')->name('image');
	});
	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/intro', function() {
		return view('intro');
	});
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');