<?php

namespace Modules\Core\Services;

use Illuminate\Support\Facades\Log;
use Modules\Core\Services\ReplayCrawlerService;

class CrawlerService
{
    public static function handle()
    {
        $replayCrawlerUrls  = ReplayCrawlerService::getReplayCrawlerUrls();
        
        $requestsPerTask    = config('crawler.wotreplays.requests_per_task');
        $minDelay           = config('crawler.wotreplays.delay_in_seconds_min');
        $maxDelay           = config('crawler.wotreplays.delay_in_seconds_max');

        foreach ($replayCrawlerUrls as $region => $replayCrawlerUrls) {
            for ($i = 0; $i <= $requestsPerTask; $i++) {
                $domDocument = new \DOMDocument();

                @$domDocument->loadHTMLFile($replayCrawlerUrls . '/' . ReplayCrawlerService::getStartingReplayNumber($region) . '#stats');
        
                $domxPath = new \DOMXPath($domDocument);
        
                $result = $domxPath->query("//*[contains(@class, 'replay-stats__title')]")->item(0)->textContent;
        
                /* $spaner = $domxPath->query("//*[contains(@class, 'replay-stats__subtitle')]"); map-name & battle_type */
        
                /* $spaner = $domxPath->query("//*[contains(@class, 'b-replay__img_wrap')]"); spawn */
        
                /* $spaner = $domxPath->query("//*[contains(@class, 'replay-details__timings')]"); battle duration NEEDS #details */
                
                /* $spaner = $domxPath->query("//*[contains(@class, 'replay__info clearfix')]"); patch */
                
                // random delay between calls
                sleep(rand($minDelay, $maxDelay));

                dd($result);
            }
        }

        return view('core::index');
    }
}