<?php

Route::post('/register', 'ClientApiController@register');
Route::post('/login', 'ClientApiController@login');
Route::get('/test', 'ClientApiController@test');
Route::put('/logout', 'WebController@logout');
Route::post('/booking/{roomId}', 'ClientApiController@booking');
Route::post('/rate/{hotelId}', 'ClientApiController@rate');