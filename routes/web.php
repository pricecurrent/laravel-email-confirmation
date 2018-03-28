<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('products', 'ProductsController@index')->middleware(['auth', 'confirmed']);

Route::get('users/{user}/request-confirmation', 'UsersEmailConfirmationController@request')->name('request-confirm-email')->middleware('auth');
Route::post('users/{user}/send-confirmation-email', 'UsersEmailConfirmationController@sendEmail')->name('send-confirmation-email')->middleware('auth');
Route::get('users/{user}/confirm-email/{token}', 'UsersEmailConfirmationController@confirm')->name('confirm-email');
