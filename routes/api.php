<?php
use Illuminate\Support\Facades\Route;

Route::prefix('api')->namespace('Hanoivip\User\Controllers')->group(function () {
    Route::any('/admin/pass/reset', 'AdminController@resetPassword');
    Route::any('/admin/token', 'AdminController@generateToken');
    Route::any('/admin/user', 'AdminController@userInfo');
    Route::any('/otp/check', 'OtpController@check');
    Route::any('/otp/sendmail', 'OtpController@sendMail');
    Route::any('/otp/sendsms', 'OtpController@sendSms');
    // verify device
    Route::any('/verify/init', 'TwofaController@verify');
    Route::any('/verify', 'TwofaController@doVerify');
    // forgot password - new flow - reset with verification methods
    Route::any('/forgot/list', 'AppForgot@listWays');
    Route::any('/forgot/init', 'AppForgot@verifyUser');
    Route::any('/forgot/check', 'AppForgot@checkVerifyUser');
    Route::any('/forgot/reset', 'AppForgot@resetPassword');
});

Route::prefix('api')->middleware('otp')
    ->namespace('Hanoivip\User\Controllers')
    ->group(function () {
    Route::any('/pass/resetByOtp', 'PublicController@resetPassByOtp');
});

Route::prefix('api')->middleware('auth:api')
    ->namespace('Hanoivip\User\Controllers')
    ->group(function () {
    Route::any('/pass/update', 'CredentialController@doUpdatePassword');
});