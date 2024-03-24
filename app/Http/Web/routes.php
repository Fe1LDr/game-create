<?php

use App\Http\Web\Controllers\HealthCheck;
use App\Http\Web\Controllers\OasController;
use App\Http\ApiV1\Modules\Games\Controllers\GamesController;
use Illuminate\Support\Facades\Route;

Route::get('/', 'GamesController@index');

Route::post('/games/store', 'GamesController@store');

Route::get('/games/show/{id}', 'GamesController@show');

Route::put('/games/update/{id}', 'GamesController@update');

Route::delete('/games/destroy/{id}', 'GamesController@destroy');
