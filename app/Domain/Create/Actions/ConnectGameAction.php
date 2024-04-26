<?php

namespace App\Domain\Create\Actions;

use App\Domain\Create\Models\Game;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ConnectGameAction
{
    public function execute(array $data): \Exception|null
    {
        try {
            $game = Game::find($data['id']);
            if ($game == null) {
                throw new NotFoundResourceException("Game not found");
            }
            if ($game->player_white != null) {
                $game->player_black = $data['user_id'];
            } else {
                $game->player_white = $data['user_id'];
            }
            //$response = http::post("http://127.0.0.3:8000/trans/start", $game);
            $game->delete();
        } catch (\Exception $e) {
            return $e;
        }

        return null;
    }
}
