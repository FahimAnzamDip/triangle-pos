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
    Route::resource('groups', 'GroupController');
    // Optionally, add a route for the Livewire UI page
    Route::view('master/groups', 'groups::groups.index')->name('groups.master.index');
});
