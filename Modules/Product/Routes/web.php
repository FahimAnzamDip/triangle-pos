<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//Product
Route::resource('products', 'ProductController');

//Product Category
Route::resource('product-categories', 'CategoriesController')->except('create', 'show');
