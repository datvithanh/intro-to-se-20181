<?php 

Auth::routes();

Route::get('/', function(){
    return redirect('/home');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/hotel/create', 'HomeController@createHotel');
Route::get('/room/create', 'HomeController@createRoom');
Route::get('/hotel/{hotelId}', 'HomeController@hotel');
Route::get('/hotel/{hotelId}/edit', 'HomeController@editHotel');
Route::get('/room/{roomId}/edit', 'HomeController@editRoom');