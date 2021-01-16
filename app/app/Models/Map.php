<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    protected $fillable = [
        'name',
        'type'
    ];

    public function battleTypes()
    {
        return $this->hasMany(BattleType::class);
    }

    public function battleStatistics()
    {
        return $this->hasMany(BattleStatistics::class);
    }
}
