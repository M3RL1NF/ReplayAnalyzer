<?php

namespace Modules\Core\Services;

use Illuminate\Support\Facades\Log;
use App\Models\BattleStatistic; 
use App\Models\BattleType; 
use App\Models\Map; 
use App\Models\MapBattleType; 
use Modules\Core\Services\ReplayCrawlerService;

class CrawlerService
{
    public static function handle()
    {
        $replayCrawlerUrls  = ReplayCrawlerService::getReplayCrawlerUrls();
        $requestsPerTask    = config('crawler.wotreplays.requests_per_task');
        $minDelay           = config('crawler.wotreplays.delay_in_seconds_min');
        $maxDelay           = config('crawler.wotreplays.delay_in_seconds_max');
        $battleStatistics   = [];

        foreach ($replayCrawlerUrls as $region => $replayCrawlerUrls) {
            for ($i = 0; $i < $requestsPerTask; $i++) {
                $domDocument = new \DOMDocument();

                $replayNumber = ReplayCrawlerService::getReplayNumber($region) + $i;

                @$domDocument->loadHTMLFile($replayCrawlerUrls . '/' . $replayNumber . '#stats');
        
                $domxPath = new \DOMXPath($domDocument);
        
                // get text content of website
                $resultQuery                = $domxPath->query("//*[contains(@class, 'replay-stats__title')]");
                $resultContent              = $resultQuery->item(0)->textContent;
                $result                     = trim($resultContent);

                $mapAndBattleTypeQuery      = $domxPath->query("//*[contains(@class, 'replay-stats__subtitle')]");
                $mapAndBattleTypeContent    = $mapAndBattleTypeQuery->item(0)->textContent;
                $mapAndBattleType           = trim($mapAndBattleTypeContent);

                $spawnRawQuery              = $domxPath->query("//*[contains(@class, 'b-replay__img_wrap')]");
                $spawnRawContent            = $spawnRawQuery->item(0)->textContent;
                $spawnRaw                   = trim($spawnRawContent);

                $replayInfoQuery            = $domxPath->query("//*[contains(@class, 'replay__info clearfix')]");
                $replayInfoContent          = $replayInfoQuery->item(0)->textContent;
                $replayInfo                 = trim($replayInfoContent);

                $battleDurationRawQuery     = $domxPath->query("//*[contains(@class, 'replay-details__timings')]");
                $battleDurationRawContent   = $battleDurationRawQuery->item(0)->textContent;
                $battleDurationRaw          = trim($battleDurationRawContent);

                // adjust raw text content
                $map                = explode(' – ', $mapAndBattleType)[0];
                $battleType         = explode(' – ', $mapAndBattleType)[1];
                $spawnString        = explode(': ', $spawnRaw)[1];
                $patch              = trim(explode('Server', trim(str_replace("\n", "", explode(':', $replayInfo)[1])))[0]);
                $gameMode           = trim(explode('Battle type:', explode('Uploaded', $replayInfo)[0])[1]);
                $battleDuration     = str_replace(' s', '', str_replace(' min ', ':', trim(explode('duration', trim(str_replace("\n", "", explode('Time', $battleDurationRaw)[1])))[1])));
                $serverGameTime     = trim(explode('Spawn:', explode('time:', $replayInfo)[1])[0]);

                $spawnString == 'I' ? $spawn = '1' : $spawn = '2';
                
                $battleStatistics[] = [
                    'map' => $map,
                    'battleType' => $battleType,
                    'gameMode' => $gameMode,
                    'replayNumber' => $replayNumber,
                    'spawn' => $spawn,
                    'result' => $result,
                    'duration' => $battleDuration,
                    'serverGameTime' => $serverGameTime,
                    'patch' => $patch,
                    'region' => $region,
                ];

                // random delay between calls
                // sleep(rand($minDelay, $maxDelay));
            }
        }

        self::store($battleStatistics);

        return view('core::index');
    }

    public static function store($battleStatistics = null) 
    {
        if ($battleStatistics) {
            foreach ($battleStatistics as $battleStatistic) {
                $map = Map::firstOrCreate([
                    'name' => $battleStatistic['map']
                ]);

                $battleType = BattleType::firstOrCreate([
                    'name' => $battleStatistic['battleType']
                ]);

                MapBattleType::firstOrCreate([
                    'map_id' => $map->id,
                    'battle_type_id' => $battleType->id
                ]);

                BattleStatistic::create([
                    'map_id'            => $map->id,
                    'battle_type_id'    => $battleType->id,
                    'game_mode'         => $battleStatistic['gameMode'],
                    'replay_number'     => $battleStatistic['replayNumber'],
                    'spawn'             => $battleStatistic['spawn'],
                    'result'            => $battleStatistic['result'],
                    'duration'          => $battleStatistic['duration'],
                    'server_game_time'  => $battleStatistic['serverGameTime'],
                    'patch'             => $battleStatistic['patch'],
                    'region'            => $battleStatistic['region']
                ]);
            }
        }

        return true;
    }
}