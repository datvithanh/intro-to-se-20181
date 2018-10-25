<?php 

Route::get('/', 'HomeController@owner');
Route::get('/rooms', 'HomeController@room')->name('room');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();