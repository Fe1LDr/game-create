<?php

namespace App\Domain\Create\Actions;

use App\Domain\Create\Models\Game;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ConnectGameAction
{
    public function execute(array $data): null
    {
        $game = Game::find($data['id']);
        if ($game == null) {
            throw new NotFoundResourceException("Game not found");
        }
        if ($game->player_white != null) {
            $game->player_black = $data['user_id'];
        } else {
            $game->player_white = $data['user_id'];
        }
        $response = http::post("http://127.0.0.3:8000/manage/start", $game);
        $game->delete();

        return null;
    }
}
