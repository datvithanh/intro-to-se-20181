<?php

Route::post('/register', 'ClientApiController@register');
Route::post('/login', 'ClientApiController@login');
Route::get('/test', 'ClientApiController@test');
Route::put('/logout', 'ClientApiController@logout');