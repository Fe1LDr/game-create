<?php
namespace App\Domain\News\Models;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id
 * @property int $user_id
 * @property string $game_name
 * @property int $primary_time
 * @property int $added_time
 * @property int $color
 */
class Create extends Model
{
    protected $table = 'waiting_games';
}
