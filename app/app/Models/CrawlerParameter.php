<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrawlerParameter extends Model
{ 
    protected $fillable = [
        'crawler_domain_name_id',
        'name',
    ];

    public function crawlerDomainName()
    {
        return $this->belongsTo(CrawlerDomainName::class);
    }
}
