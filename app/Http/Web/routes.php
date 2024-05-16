<?php

use App\Http\ApiV1\Modules\Games\Controllers\GamesController;
use Illuminate\Support\Facades\Route;

Route::get('/games', 'GamesController@showAll');

Route::post('/games/create', 'GamesController@create');

Route::post('/games/connect', 'GamesController@connect');

Route::post('/games/destroy', 'GamesController@destroy');
