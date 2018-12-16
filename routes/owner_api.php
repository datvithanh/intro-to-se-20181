<?php 

Route::post('/hotel', 'OwnerApiController@createHotel');
Route::put('/hotel/{hotelId}', 'OwnerApiController@editHotel');
Route::post('/hotel/{hotelId}/room', 'OwnerApiController@createRoom');
Route::post('/upload', 'OwnerApiController@uploadImage');
Route::post('/room', 'OwnerApiController@createRoom');
Route::put('/room/{roomId}', 'OwnerApiController@editRoom');
Route::delete('/room/{roomId}', 'OwnerApiController@deleteRoom');