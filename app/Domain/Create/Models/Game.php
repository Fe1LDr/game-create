<?php

namespace App\Domain\Create\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $player_white
 * @property string $player_black
 * @property string $game_name
 * @property int $primary_time
 * @property int $added_time
 */

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
    protected $guarded = []; // false
}
