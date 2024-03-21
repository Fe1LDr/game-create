<?php

use App\Http\Web\Controllers\HealthCheck;
use App\Http\Web\Controllers\OasController;
use App\Http\ApiV1\Modules\Games\Controllers\GamesController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'GamesController@index');

Route::get('/games/create/{gamesArr}', 'GamesController@create');

Route::get('/games/get/{game_id}', 'GamesController@get');

Route::get('/games/delete/{id}', 'GamesController@delete');
