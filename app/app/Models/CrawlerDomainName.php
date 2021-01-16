<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrawlerDomainName extends Model
{
    protected $fillable = [
        'name',
    ];

    public function crawlerParameters()
    {
        return $this->hasMany(CrawlerParameter::class);
    }

    public function crawlerPaths()
    {
        return $this->hasMany(CrawlerPath::class);
    }

    public function crawlerTopLevelDomains()
    {
        return $this->hasMany(CrawlerTopLevelDomain::class);
    }
}
