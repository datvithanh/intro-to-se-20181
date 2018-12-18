<?php

Route::get('/', 'WebController@index');

Route::get('/login', 'WebController@login');

Route::get('/register', 'WebController@register');

Route::get('/search', 'WebController@search');

Route::get('/hotel/{hotelId}', 'WebController@hotelRoom');

Route::get('/booking/{roomId}', 'WebController@booking');

Route::get('/profile', 'WebController@profile');