<?php

use App\Http\ApiV1\Modules\Games\Controllers\GamesController;
use Illuminate\Support\Facades\Route;

Route::get('/games', 'GamesController@showAll');

Route::post('/games/create', 'GamesController@create');

Route::put('/games/connect', 'GamesController@connect');

Route::delete('/games/destroy', 'GamesController@destroy');
