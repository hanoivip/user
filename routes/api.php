<?php
use Illuminate\Support\Facades\Route;

Route::prefix('api')->namespace('Hanoivip\User\Controllers')->group(function () {
    Route::any('/admin/pass/reset', 'AdminController@resetPassword');
    Route::any('/admin/token', 'AdminController@generateToken');
    Route::any('/admin/user', 'AdminController@userInfo');
    Route::any('/otp/check', 'OtpController@check');
    Route::any('/otp/sendmail', 'OtpController@sendMail');
    Route::any('/otp/sendsms', 'OtpController@sendSms');
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
    // verify device
    Route::any('/verify', 'TwofaController@verify');
    Route::any('/verify/do', 'TwofaController@doVerify');
    // verify email from app
    Route::get('/user/info', 'CredentialController@infoUI');
    Route::any('/user/email/update', 'CredentialController@doUpdateEmail');
    // 2fa
    Route::get('/2fa/status', 'AppTwofa@status');
    Route::any('/2fa/add/init', 'AppTwofa@beginAdd');
    Route::any('/2fa/add', 'AppTwofa@add');
    Route::any('/2fa/validate', 'AppTwofa@validate1');
});