<?php
use Illuminate\Support\Facades\Route;

Route::prefix('api')->namespace('Hanoivip\User\Controllers')->group(function () {
    Route::any('/admin/pass/reset', 'AdminController@resetPassword');
    Route::any('/admin/token', 'AdminController@generateToken');
    Route::any('/admin/user', 'AdminController@userInfo');

    Route::any('/pass/reset', 'PublicController@resetPass');
    Route::any('/otp/sendmail', 'OtpController@sendMail');
    Route::any('/otp/sendsms', 'OtpController@sendSms');
});

Route::prefix('api')->middleware('auth:api')
    ->namespace('Hanoivip\User\Controllers')
    ->group(function () {
    Route::any('/pass/update', 'CredentialController@doUpdatePassword');
});