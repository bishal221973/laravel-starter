<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/change-profile', [ProfileController::class, 'changeProfile'])->name('changeProfile');
Route::post('/change-cover', [ProfileController::class, 'changeCover'])->name('changeCover');
Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
Route::get('/forget-password', [ProfileController::class, 'forgetPassword'])->name('forgetPassword');
Route::get('/forget-password/code', [ProfileController::class, 'getCode'])->name('getCode');
Route::delete('remove-otp/{email}', [OTPController::class, 'delete'])->name('otp.delete');
Route::get('/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
Route::post('/update-password', [ProfileController::class, 'updateMyPassword'])->name('updateMyPassword');

Route::get('/settings', [SettingController::class, "index"])->name('setting.index');
Route::post('/change-personal-details', [SettingController::class, "personalDetail"])->name('setting.personalDetail');
Route::post('/change-email', [SettingController::class, "changeEmail"])->name('setting.changeEmail');
Route::post('/change-phone', [SettingController::class, "changePhone"])->name('setting.changePhone');
Route::get('/select-province/{id}', [SettingController::class, "selectProvince"])->name('setting.selectProvince');
Route::get('/select-district/{id}', [SettingController::class, "selectDistrict"])->name('setting.selectDistrict');
Route::get('/select-municipality/{id}', [SettingController::class, "selectMunicipality"])->name('setting.selectMunicipality');

Route::post('/change-address', [SettingController::class, "changeAddress"])->name('setting.changeAddress');

Route::get('/verify-email', [SettingController::class, "verifyEmail"])->name('setting.verifyEmail');
Route::get('/enter-verification-code', [SettingController::class, "verifyCode"])->name('setting.verifyCode');
Route::get('/email-verification-code', [SettingController::class, "verifyEmailCode"])->name('setting.verifyEmailCode');

Route::post('/app-setting', [SettingController::class, "appSetting"])->name('setting.appSetting');
Route::post('/mail-setting', [SettingController::class, "mailSetting"])->name('setting.mailSetting');

Route::get('create-role',[RoleController::class,'create'])->name('role.create');
Route::post('store-role',[RoleController::class,'store'])->name('role.store');

Route::resource('country',CountryController::class);

Route::get('/',[FrontController::class,'index'])->name('front.index');
Route::get('/flight-lists',[FrontController::class,'list'])->name('front.list');
Route::post('/flight-detail/{amadeus}',[FrontController::class,'detail'])->name('front.detail');
Route::post('/flight-booking',[FrontController::class,'book'])->name('front.book');
