<?php

namespace App\Http\ApiV1\Modules\Games\Controllers;

use App\Domain\Create\Models\Games;
use Illuminate\Routing\Controller;

class GamesController extends Controller
{
    public function index()
    {
        $games = Games::all();
        foreach ($games as $game) {
            dump($game);
        }
        dd('end');
    }

    public function create($game)
    {

        $gamesArr2 = [
            [
                'id' => '2',
                'user_id' => '2234',
                'game_name' => 'agaga',
                'primary_time' => '10000000',
                'added_time' => '1000',
                'color' => '1',
            ],
        ];
        dd($game);
        Games::create($game);
        dd('created');
    }

    public function get(int $id)
    {
        return Games::find($id);
    }

    public function delete(int $id)
    {
        $game = Games::find($id);
        $game->delete();
        dd('deleted');
    }
}
