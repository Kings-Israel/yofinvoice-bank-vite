<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\laravel_example\UserManagement;

$controller_path = 'App\Http\Controllers';

Route::group(['prefix' => '{bank:url}/'], function () use ($controller_path) {
  Route::group(['middleware' => 'guest'], function () use ($controller_path) {
    Route::get('login', $controller_path . '\AuthController@showLoginForm')->name('login');
    Route::post('login', $controller_path . '\AuthController@login')->name('login.submit');
    Route::get('forgot-password', $controller_path . '\ForgotPasswordController@showForgotPasswordForm')->name('forgot.password');
  });

  Route::post('logout', $controller_path . '\AuthController@destroy')->name('logout')->middleware('auth');
});
