<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MapBattleType extends Model
{
    public $table = 'maps_battle_types';

    protected $fillable = [
        'map_id',
        'battle_type_id'
    ];

    public $timestamps = false;

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function battleType()
    {
        return $this->belongsTo(BattleType::class);
    }
}
