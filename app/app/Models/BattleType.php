<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BattleType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function battleStatistic()
    {
        return $this->has(BattleStatistic::class);
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }
}
