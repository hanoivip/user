<?php
use Illuminate\Support\Facades\Route;

Route::prefix('api')->namespace('Hanoivip\User\Controllers')->group(function () {
    Route::any('/admin/pass/reset', 'AdminController@resetPassword');
    Route::any('/admin/token', 'AdminController@generateToken');
    Route::any('/admin/user', 'AdminController@userInfo');

    Route::any('/otp/check', 'OtpController@check');
    Route::any('/pass/resetByOtp', 'PublicController@resetPassByOtp');
    Route::any('/otp/sendmail', 'OtpController@sendMail');
    Route::any('/otp/sendsms', 'OtpController@sendSms');
    
    Route::any('/verify/need', 'TwofaController@needVerify');
    Route::any('/verify/init', 'TwofaController@verify');
    Route::any('/verify', 'TwofaController@doVerify');
    Route::any('/verify/list', 'TwofaController@listWays');
});

Route::prefix('api')->middleware('auth:api')
    ->namespace('Hanoivip\User\Controllers')
    ->group(function () {
    Route::any('/pass/update', 'CredentialController@doUpdatePassword');
});