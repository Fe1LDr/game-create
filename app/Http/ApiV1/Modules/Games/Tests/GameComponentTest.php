<?php
use App\Domain\Create\Actions\AuthorizeAction;
use App\Domain\Create\Actions\ConnectGameAction;
use App\Domain\Create\Models\Game;
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
    $authorizeActionMock = Mockery::mock(AuthorizeAction::class);

    $authorizeActionMock->shouldReceive('execute')
        ->once()
        ->andReturnUsing(function ($data) {
            return $data;
        });
    $this->app->instance(AuthorizeAction::class, $authorizeActionMock);

    $request = [
        "username" => "user",
        "password" => "password",
        "game_name" => "Kizil",
        "player_color" => "white",
        "primary_time" => 60000,
        "added_time" => 10000,
    ];
    $this->postJson('/games/create', $request)->assertStatus(500);
});

test('POST /games/connect 202', function () {
    $authorizeActionMock = Mockery::mock(AuthorizeAction::class);
    $connectActionMock = Mockery::mock(ConnectGameAction::class);

    $authorizeActionMock->shouldReceive('execute')
        ->once()
        ->andReturnUsing(function ($data) {
            return $data;
        });
    $connectActionMock->shouldReceive('execute')
        ->once()
        ->andReturn(null);
    $this->app->instance(AuthorizeAction::class, $authorizeActionMock);
    $this->app->instance(ConnectGameAction::class, $connectActionMock);

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
    $authorizeActionMock = Mockery::mock(AuthorizeAction::class);

    $authorizeActionMock->shouldReceive('execute')
        ->once()
        ->andReturnUsing(function ($data) {
            return $data;
        });
    $this->app->instance(AuthorizeAction::class, $authorizeActionMock);

    Game::factory()->make();
    $request = [
        'id' => 4,
        'game_name' => "kizil",
        'player_color' => "black",
        'primary_time' => 60000,
        'added_time' => 10000,
        'username' => "user",
        'password' => 'password',
    ];
    postJson('/games/destroy', $request)->assertStatus(204);
});

test('POST /games/destroy 404', function () {
    $authorizeActionMock = Mockery::mock(AuthorizeAction::class);

    $authorizeActionMock->shouldReceive('execute')
        ->once()
        ->andReturnUsing(function ($data) {
            return $data;
        });
    $this->app->instance(AuthorizeAction::class, $authorizeActionMock);

    $request = [
        'id' => 1123,
        'username' => 'user',
        'password' => 'password',
        "game_name" => "Test",
        "player_color" => "white",
        "primary_time" => 60000,
        "added_time" => 10000,
    ];
    postJson('/games/destroy', $request)->assertStatus(404);
});
