<?php

$generatedRoutes = __DIR__ . "/OpenApiGenerated/routes.php";
if (file_exists($generatedRoutes)) { // prevents your app and artisan from breaking if there is no autogenerated Route file for some reason.
    require $generatedRoutes;
}

Route::get('/', function () {
    return 'aaaaaaaaaaa';
});

Route::get('/games', 'GamesController@showAll');
Route::post('/games/create', 'GamesController@create');
