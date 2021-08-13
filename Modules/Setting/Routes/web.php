<?php

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

Route::group(['middleware' => 'auth'], function () {

    //Mail Settings
    Route::patch('/settings/smtp', 'SettingController@updateSmtp')->name('settings.smtp.update');
    //General Settings
    Route::get('/settings', 'SettingController@index')->name('settings.index');
    Route::patch('/settings', 'SettingController@update')->name('settings.update');

});
