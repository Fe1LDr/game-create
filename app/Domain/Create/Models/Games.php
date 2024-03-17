<?php

namespace App\Domain\Create\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $game_name
 * @property int $primary_time
 * @property int $added_time
 * @property int $color
 */

class Games extends Model
{
    use HasFactory;
}
