<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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


// Route::group(['middleware' => 'auth'], function () {
Route::get('/', [HomeController::class, 'home']);
Route::get('/dashboard', function (Request $request) {
	$bulanSelect = $request->input('bulanSelect', 10); // Defaultnya 1 (Januari)
	$response = Http::get('http://8.219.80.74:3000/transactions/charts?month=' . $bulanSelect);
	$data = $response->json();
	return view('dashboard', ['data' => $data, 'bulanSelect' => $bulanSelect]);
})->name('dashboard');

// Route::get('/semua', function (Request $request) {
// 	$dateStart = $request->input('dateStart', '2023-10-01');
// 	$dateEnd = $request->input('dateEnd', '2023-10-13');
// 	$outletSelect = $request->input('outletSelect', ['904921']);
// 	$outletSelect = implode('&outlets=', $outletSelect);
// 	$response = Http::get('http://8.219.80.74:3000/transactions/charts?start=' . $dateStart . '&end=' . $dateEnd . '&outlets=' . $outletSelect);
// 	$data = $response->json();
// 	// dd($response);
// 	return view('semua', ['data' => $data, 'dateStart' => $dateStart, 'dateEnd' => $dateEnd, 'outletSelect' => $outletSelect]);
// })->name('semua');
// });

Route::get('/dygraph', function (Request $request) {
	return view('dygraph');
});
Route::get('/semua', function () {
	$response = Http::get('http://8.219.80.74:3000/transactions/charts?start=2023-04-20&format=chartjs');
	$data = $response->json();
	return view('chartjs', ['data' => $data]);
});

Route::get('billing', function () {
	return view('billing');
})->name('billing');

Route::get('profile', function () {
	return view('profile');
})->name('profile');

Route::get('rtl', function () {
	return view('rtl');
})->name('rtl');

Route::get('user-management', function () {
	return view('laravel-examples/user-management');
})->name('user-management');

Route::get('tables', function () {
	return view('tables');
})->name('tables');

Route::get('virtual-reality', function () {
	return view('virtual-reality');
})->name('virtual-reality');

Route::get('static-sign-in', function () {
	return view('static-sign-in');
})->name('sign-in');

Route::get('static-sign-up', function () {
	return view('static-sign-up');
})->name('sign-up');

Route::get('/logout', [SessionsController::class, 'destroy']);
Route::get('/user-profile', [InfoUserController::class, 'create']);
Route::post('/user-profile', [InfoUserController::class, 'store']);
Route::get('/login', function () {
	return view('dashboard');
})->name('sign-up');
// });



// Route::group(['middleware' => 'guest'], function () {
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [SessionsController::class, 'create']);
Route::post('/session', [SessionsController::class, 'store']);
Route::get('/login/forgot-password', [ResetController::class, 'create']);
Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
// });

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');
