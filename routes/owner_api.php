<?php 

Route::post('/hotel', 'OwnerApiController@createHotel');
Route::put('/hotel/{hotelId}', 'OwnerApiController@editHotel');
Route::post('/hotel/{hotelId}/room', 'OwnerApiController@createRoom');