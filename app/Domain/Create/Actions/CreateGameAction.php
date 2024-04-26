<?php

namespace App\Domain\Create\Actions;

use App\Domain\Create\Models\Game;
use Illuminate\Support\Facades\Http;
use Mockery\Exception;

class CreateGameAction
{
    public function execute(array $data): Game|Exception
    {
        try {
            $game = new Game();
            $game->game_name = $data['game_name'];
            if ($data['player_color'] === "white") {
                $game->player_white = $data['user_id'];
            } else {
                $game->player_black = $data['user_id'];
            }
            $game->primary_time = $data['primary_time'];
            $game->added_time = $data['added_time'];
        } catch (Exception $e) {
            return $e;
        }
        $game->save();

        return $game;
    }
}
