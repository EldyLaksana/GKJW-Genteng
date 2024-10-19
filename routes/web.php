<?php

use App\Http\Controllers\BackendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;

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

// Route::get('/', function () {
//     return view('frontend.index');
// });

// Frontend
Route::get('/', [FrontendController::class, 'index']);

Route::get('/warta-jemaat', [FrontendController::class, 'warta']);

Route::get('/kontak', [FrontendController::class, 'kontak']);

Route::get('/renungan', [FrontendController::class, 'renungan']);

Route::get('/kabar-jemaat', [FrontendController::class, 'kabar']);

Route::get('/sejarah', [FrontendController::class, 'sejarah']);


// Backend

Route::get('/dashboard', [BackendController::class, 'index']);
