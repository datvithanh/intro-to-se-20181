<?php 

Route::post('/hotel', 'OwnerApiController@createHotel');
Route::post('/hotel/{hotelId}/room', 'OwnerApiController@createRoom');