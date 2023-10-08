<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[FrontController::class,'index'])->name('front.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('role');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('role');
Route::post('/change-profile', [ProfileController::class, 'changeProfile'])->name('changeProfile')->middleware('role');
Route::post('/change-cover', [ProfileController::class, 'changeCover'])->name('changeCover')->middleware('role');
Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('changePassword')->middleware('role');
Route::get('/forget-password', [ProfileController::class, 'forgetPassword'])->name('forgetPassword')->middleware('role');
Route::get('/forget-password/code', [ProfileController::class, 'getCode'])->name('getCode')->middleware('role');
Route::delete('remove-otp/{email}', [OTPController::class, 'delete'])->name('otp.delete')->middleware('role');
Route::get('/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword')->middleware('role');
Route::post('/update-password', [ProfileController::class, 'updateMyPassword'])->name('updateMyPassword')->middleware('role');

Route::get('/settings', [SettingController::class, "index"])->name('setting.index')->middleware('role');
Route::post('/change-personal-details', [SettingController::class, "personalDetail"])->name('setting.personalDetail')->middleware('role');
Route::post('/change-email', [SettingController::class, "changeEmail"])->name('setting.changeEmail')->middleware('role');
Route::post('/change-phone', [SettingController::class, "changePhone"])->name('setting.changePhone')->middleware('role');
Route::get('/select-province/{id}', [SettingController::class, "selectProvince"])->name('setting.selectProvince')->middleware('role');
Route::get('/select-district/{id}', [SettingController::class, "selectDistrict"])->name('setting.selectDistrict')->middleware('role');
Route::get('/select-municipality/{id}', [SettingController::class, "selectMunicipality"])->name('setting.selectMunicipality')->middleware('role');

Route::post('/change-address', [SettingController::class, "changeAddress"])->name('setting.changeAddress')->middleware('role');

Route::get('/verify-email', [SettingController::class, "verifyEmail"])->name('setting.verifyEmail')->middleware('role');
Route::get('/enter-verification-code', [SettingController::class, "verifyCode"])->name('setting.verifyCode')->middleware('role');
Route::get('/email-verification-code', [SettingController::class, "verifyEmailCode"])->name('setting.verifyEmailCode')->middleware('role');

Route::post('/app-setting', [SettingController::class, "appSetting"])->name('setting.appSetting')->middleware('role');
Route::post('/mail-setting', [SettingController::class, "mailSetting"])->name('setting.mailSetting')->middleware('role');
Route::post('/organization-setting', [SettingController::class, "orgSetting"])->name('setting.orgSetting')->middleware('role');

Route::get('create-role',[RoleController::class,'create'])->name('role.create')->middleware('role');
Route::post('store-role',[RoleController::class,'store'])->name('role.store')->middleware('role');

Route::resource('country',CountryController::class)->middleware('role');
Route::get('report',[ReportController::class,'report'])->name('report')->middleware('role');
Route::get('report-filter',[ReportController::class,'reportFilter'])->name('reportFilter')->middleware('role');
Route::get('export-excel',[ReportController::class,'exportExcel'])->name('exportExcel')->middleware('role');

Route::get('users',[UserController::class,'index'])->name('user.index')->middleware('role');
Route::post('users',[UserController::class,'store'])->name('user.store')->middleware('role');
Route::get('users/{id}',[UserController::class,'edit'])->name('user.edit')->middleware('role');
Route::put('users/{id}',[UserController::class,'update'])->name('user.update')->middleware('role');
Route::get('users/{id}/delete',[UserController::class,'destroy'])->name('user.destroy')->middleware('role');
Route::resource('agency',AgencyController::class)->middleware('role');





Route::get('/flight-lists',[FrontController::class,'list'])->name('front.list');
Route::post('/contacts-us',[FrontController::class,'contactUs'])->name('front.contactUs');
Route::post('/flight-detail/{amadeus}',[FrontController::class,'detail'])->name('front.detail');
Route::get('/flight-details',[FrontController::class,'showDetails'])->name('front.showDetails');
Route::post('/flight-booking',[FrontController::class,'book'])->name('front.book');

Route::post('/user-registration',[RegisterController::class,'register'])->name('user.register');
Route::get('/user-profile',[RegisterController::class,'profile'])->name('user.profile');
Route::get('/user-dashboard',[RegisterController::class,'dashboard'])->name('user.dashboard');
Route::get('/my-booking-lists',[RegisterController::class,'myBooking'])->name('user.myBooking');
Route::get('/my-profile',[RegisterController::class,'myProfile'])->name('user.myProfile');

Route::get('/my-bookings',[RegisterController::class,'myBookings'])->name('user.myBookings');
Route::get('/download-pdf/{id}',[RegisterController::class,'pdf'])->name('user.pdf');
Route::get('/cancel-booking/{id}',[FrontController::class,'cancelation'])->name('flight.cancelation');
Route::get('/review',[FrontController::class,'review'])->name('flight.review');

Route::get('reviews',[ReviewController::class,'store'])->name('reviews.store');
Route::get('review-lists',[ReviewController::class,'index'])->name('reviews.index');
Route::get('review/{id}',[ReviewController::class,'edit'])->name('reviews.edit');
Route::get('reviews-update/{id}',[ReviewController::class,'update'])->name('reviews.update');
Route::get('reviews-delete/{id}',[ReviewController::class,'delete'])->name('reviews.delete');


Route::get('service/{id}/delete',[ServiceController::class,'deletes'])->name('service')->middleware('role');
Route::resource('servece',ServiceController::class)->middleware('role');


Route::get('/migrate',function(){
    $exitCode=Artisan::call('migrate');
});

Route::get('/migrate-refresh',function(){
    $exitCode=Artisan::call('migrate:refresh');
});

Route::get('/seed',function(){
    $exitCode=Artisan::call('db:seed');
    return $exitCode;
});

Route::get('/schedule',function(){
    $exitCode=Artisan::call('schedule:run');
    return $exitCode;
});
