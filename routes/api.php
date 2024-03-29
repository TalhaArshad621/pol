<?php

use App\Http\Controllers\API\BBRequestApiController;
use App\Http\Controllers\API\BloodBagApiController;
use App\Http\Controllers\API\CampaignApiController;
use App\Http\Controllers\API\DonationApiController;
use App\Http\Controllers\API\DonatorApiController;
use App\Http\Controllers\API\LocationApiController;
use App\Http\Controllers\API\PatientApiController;
use App\Http\Controllers\API\ReportApiController;
use App\Http\Controllers\API\RequestApiController;
use App\Http\Controllers\API\UserApiController;
use App\Http\Controllers\API\UserGroupApiController;
use App\Http\Controllers\CampaignController;
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
Route::put('/users/{id}',[UserApiController::class, 'update'])->name('user.update');

// User Group Api
Route::get('/userGroups', [UserGroupApiController::class, 'index'])->name('userGroup.index');
Route::post('/userGroups', [UserGroupApiController::class,'store'])->name('userGroup.create');
Route::get('/userGroup/{id}',[UserGroupApiController::class,'show'])->name('userGroup.get');
Route::put('/usergroup/{id}',[UserGroupApiController::class, 'update'])->name('usergroup.update');

// Patient Api
Route::get('/patients', [PatientApiController::class, 'index'])->name('patients.index');
Route::post('/patients', [PatientApiController::class, 'store'])->name('patient.create');
Route::get('/patients/{id}', [PatientApiController::class, 'show'])->name('patient.get');
Route::delete('/patients/{id}', [PatientApiController::class, 'destroy'])->name('patient.destroy');
Route::put('/patients/{id}', [PatientApiController::class, 'update'])->name('patient.update');

// Request Api
Route::get('/requests', [RequestApiController::class, 'index'])->name('requests.index');
Route::post('/requests', [RequestApiController::class, 'store'])->name('request.create');

// Donator api
Route::get('/donators', [DonatorApiController::class, 'index'])->name('donators.index'); 
Route::post('/donators',[DonatorApiController::class, 'store'])->name('donator.create');
Route::get('/donator/{cnic}',[DonatorApiController::class, 'show'])->name('donator.get');
Route::get('/donators/{id}',[DonatorApiController::class, 'showDonator']);
Route::get('/donator-info/{id}',[DonatorApiController::class, 'donatorInfo'])->name('donator.info');
Route::post('/transfer-points',[DonatorApiController::class, 'transferPoints']);

// Donation
Route::get('/donation',[DonationApiController::class, 'index'])->name('donations.index');

// Donation Request
Route::get('/bb-request/{id}',[BBRequestApiController::class, 'show'])->name('bbRequest.get');

// Blood Bags 
Route::get('/bloodBags',[BloodBagApiController::class, 'index'])->name('bloodBag.index');

// Campaign
Route::post('/campaigns', [LocationApiController::class, 'store'])->name('campaigns.store');
Route::get('/campaigns', [LocationApiController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/{id}', [LocationApiController::class, 'show'])->name('campaign.show');
Route::put('/campaigns/{id}', [LocationApiController::class, 'update'])->name('campaign.update');
Route::get('/campaign-info',[CampaignApiController::class, 'index'])->name('campaign.info');

// Dashboard Report 
Route::get('/line-chart',[ReportApiController::class, 'index'])->name('line.chart');
Route::get('/blood-bag-report',[ReportApiController::class ,'bloodBag'])->name('bloodBag-report');

// Report

Route::get('/report',[ReportApiController::class, 'getReport'])->name('get.report');