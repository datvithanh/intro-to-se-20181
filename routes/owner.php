<?php 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/hotel'. 'HomeController@hotel')->name('hotel');
