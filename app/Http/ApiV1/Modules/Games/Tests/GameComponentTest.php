<?php

use App\Http\ApiV1\Support\Tests\ApiV1ComponentTestCase;

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

uses(ApiV1ComponentTestCase::class);
uses()->group('component');

test('GET /games 200', function () {
    getJson('/games')
        ->assertStatus(200);
});

test('POST /games/create 201', function () {
    $request = [
        "username" => "user",
        "password" => "password",
        "game_name" => "Kizil",
        "player_color" => "white",
        "primary_time" => 60000,
        "added_time" => 10000,
    ];
    postJson('/games/create', $request)->assertStatus(201);
});

test('POST /games/connect 201', function () {
    $request = [
        "id" => 2,
        "username" => "user2",
        "password" => "password2",
        "game_name" => "Test",
        "player_color" => "white",
        "primary_time" => 60000,
        "added_time" => 10000,
    ];
    postJson('/games/connect', $request)->assertStatus(202);
});

test('POST /games/destroy 204', function () {
    $request = [
        'id' => 3,
        'username' => 'user',
        'password' => 'password',
        "game_name" => "Test",
        "player_color" => "white",
        "primary_time" => 60000,
        "added_time" => 10000,
    ];
    postJson('/games/destroy', $request)->assertStatus(204);
});
