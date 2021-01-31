<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BattleStatistic extends Model
{
    protected $fillable = [
        'map_id',
        'battle_type_id',
        'game_mode',
        'replay_number',
        'spawn',
        'result',
        'duration',
        'server_game_time',
        'patch',
        'region'
    ];

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function battleType()
    {
        return $this->belongsTo(BattleType::class);
    }
}
