<?php

use Illuminate\Support\Facades\Route;

Route::any('/admin/pass/reset', 'AdminController@resetPassword');
Route::any('/admin/token', 'AdminController@generateToken');
Route::any('/admin/user', 'AdminController@userInfo');