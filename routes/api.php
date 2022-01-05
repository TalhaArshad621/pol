<?php

use App\Http\Controllers\API\PatientApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\UserGroupApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User Api

Route::get('/users', [UserApiController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserApiController::class, 'show'])->name('users.get');
Route::post('/users', [UserApiController::class, 'store'])->name('user.create');
Route::delete('/users/{id}', [UserApiController::class, 'destroy'])->name('users.destroy');

// User Group Api
Route::get('/userGroups', [UserGroupApiController::class, 'index'])->name('userGroup.index');
Route::post('/userGroups', [UserGroupApiController::class,'store'])->name('userGroup.create');

// Patient Api
Route::get('/patients', [PatientApiController::class, 'index'])->name('patients.index');
Route::post('/patients', [PatientApiController::class, 'store'])->name('patient.create');
Route::get('/patients/{id}', [PatientApiController::class, 'show'])->name('patient.get');
Route::delete('/patients/{id}', [PatientApiController::class, 'destroy'])->name('patient.destroy');