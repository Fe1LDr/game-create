<?php

namespace Database\Factories\Domain\Create\Models;

use App\Domain\Create\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Game::class;

    public function definition(): array
    {
        return [
            'game_name' => "kizil",
            'player_black' => "1",
            'primary_time' => 60000,
            'added_time' => 10000,
            'username' => "user",
            'password' => 'password',
        ];
    }
}
