<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// sanctum itu buat autentikasi jadi memastikan kalau data kita aman
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// method get
Route::get('/patients', [PatientController::class, 'index']);

// method post
Route::post('/patients', [PatientController::class, 'store']);

// method untuk mendapatkan detail data dengn GET
Route::get('/patients/{id}', [PatientController::class, 'show']);

// method put
Route::put('/patients/{id}', [PatientController::class, 'update']);

// method delete
Route::delete('/patients/{id}', [PatientController::class, 'destroy']);

// ---------- //

// method get
Route::get('/patients/search/{name}', [PatientController::class, 'index']);

// method get
Route::get('/patients/status/positive', [PatientController::class, 'index']);

// method get
Route::get('/patients/status/recovered', [PatientController::class, 'index']);

// method get
Route::get('/patients/status/dead', [PatientController::class, 'index']);


// this one is for login register and grouping (nanti kalo udh autentikasi)
// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);

// // grouping 
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::get('students');
// });