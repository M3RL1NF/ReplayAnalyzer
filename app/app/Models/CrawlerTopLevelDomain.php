<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrawlerTopLevelDomain extends Model
{
    protected $fillable = [
        'crawler_domain_name_id',
        'name',
        'enabled'
    ];

    public function crawlerDomainName()
    {
        return $this->belongsTo(CrawlerDomainName::class);
    }
}
