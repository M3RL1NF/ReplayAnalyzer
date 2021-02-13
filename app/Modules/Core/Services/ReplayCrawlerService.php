<?php

namespace Modules\Core\Services;

use App\Models\BattleStatistic;
use App\Models\CrawlerDomainName;
use App\Models\CrawlerTopLevelDomain;
use Illuminate\Support\Facades\Log;

class ReplayCrawlerService
{
    public static function getReplayCrawlerUrls()
    {
        $crawlerDomainName      = CrawlerDomainName::where('name', 'wotreplays')->first();
        $crawlerTopLevelDomains = $crawlerDomainName->crawlerTopLevelDomains;
        $replayCrawlerUrls      = [];
        
        foreach ($crawlerTopLevelDomains as $crawlerTopLevelDomain) {
            if ($crawlerTopLevelDomain->enabled == '1') {
                $replayCrawlerUrls[$crawlerTopLevelDomain->name] = 'http://' . $crawlerDomainName->name . '.' . $crawlerTopLevelDomain->name . '/' . $crawlerDomainName->crawlerPaths->first()->name;
            }
        }

        return $replayCrawlerUrls;
    }

    public static function getReplayNumber($region) 
    {
        $battleStatistic = BattleStatistic::where('region', $region)->max('replay_number');

        $startingReplayNumber = $battleStatistic ? $battleStatistic + 1 : config('wotreplays.replay_number_start.' . $region);

        return $startingReplayNumber;
    }
}