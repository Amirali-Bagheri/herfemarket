<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Auth\ConfirmPassword;
use App\Http\Livewire\Auth\FillProfile;
use App\Http\Livewire\Auth\ForgetPassword;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\LoginWithOTP;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\ResetPassword;
use App\Http\Livewire\Auth\VerifyMobile;
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
    return view('site.index');
})->name('site.index');

Route::get('/dashboard', App\Http\Livewire\Dashboard\Index::class)->name('dashboard.index');


Route::any('/login', Login::class)->middleware('guest')->name('login');
Route::any('/register', Register::class)->middleware('guest')->name('register');

Route::any('/login/otp', LoginWithOTP::class)->middleware('guest')->name('login.otp');
Route::any('/login/complete', FillProfile::class)->middleware('auth')->name('login.fill_profile');

Route::any('/mobile/verify', VerifyMobile::class)->middleware('auth')->name('phoneverification.verify');

Route::any('password/forget', ForgetPassword::class)->middleware('guest')->name('password.request');
Route::any('password/reset/{token}', ResetPassword::class)->middleware('guest')->name('password.reset');
Route::any('password/confirm', ConfirmPassword::class)->name('password.confirm');
