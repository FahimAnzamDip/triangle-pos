<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'auth'], function () {

    //Users
    Route::resource('users', 'UsersController');
    //Roles
    Route::resource('roles', 'RolesController')->except('show');

});
