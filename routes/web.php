<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\BBRequestController;
use App\Http\Controllers\BloodBagController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonatorController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReportController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/user', [UserController::class, 'index'])->name('user.index');

Route::get('/usergroup',[UserGroupController::class, 'index'])->name('usergroup.index');

// Hospital
Route::get('/patient',[PatientController::class , 'index'])->name('patient.index');
Route::get('/request',[RequestController::class, 'index'])->name('request.index');

// Blood Bank

Route::get('/b-request',[BBRequestController::class, 'index'])->name('bbrequest.index');

// Donator

Route::get('/donators', [DonatorController::class,'index'])->name('donator.index');
route::get('/donators/{id}',[DonatorController::class, 'show'])->name('donator.show');

// Donation

Route::get('/donations', [DonationController::class, 'index'])->name('donation.index');
Route::get('/donate-blood', [DonationController::class, 'create'])->name('donate.blood');
Route::post('/donation',[DonationController::class, 'store'])->name('donation.store');

// Blood bag
Route::get('/store',[BloodBagController::class, 'index'])->name('store.index');

// Campaigns
Route::get('/campaigns',[LocationController::class, 'index'])->name('campaign.index');
Route::get('/campaign-create/{id}',[LocationController::class,'create'])->name('campaign.create');
Route::post('/campaign',[LocationController::class, 'store'])->name('campaign.store');
Route::get('/campaign-start/{id}',[CampaignController::class,'create'])->name('campaign.start');
Route::get('/campaign-end/{id}',[CampaignController::class,'endCampaign'])->name('campaign.end');

// Reports
Route::get('/report',[ReportController::class, 'index'])->name('report.index');