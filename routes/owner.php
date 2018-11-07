<?php 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/hotel/create', 'HomeController@createHotel');
Route::get('/hotel/{hotelId}', 'HomeController@hotel');
Route::post('/upload', 'PublicApiController@uploadImage');