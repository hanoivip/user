<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')->namespace('Hanoivip\User\Controllers')->group(function () {
    
Route::any('/admin/pass/reset', 'AdminController@resetPassword');
Route::any('/admin/token', 'AdminController@generateToken');
Route::any('/admin/user', 'AdminController@userInfo');

});