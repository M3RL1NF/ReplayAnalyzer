<?php

namespace Modules\Core\Services;

use App\Models\BattleStatistic; 
use App\Models\BattleType; 
use App\Models\Map; 
use App\Models\MapBattleType; 
use Carbon\Carbon;
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
        $battleStatistics   = [];

        foreach ($replayCrawlerUrls as $region => $replayCrawlerUrls) {
            for ($i = 0; $i < $requestsPerTask; $i++) {
                $domDocument = new \DOMDocument();

                $replayNumber = ReplayCrawlerService::getReplayNumber($region) + $i;

                @$domDocument->loadHTMLFile($replayCrawlerUrls . '/' . $replayNumber . '#stats');
        
                $domxPath = new \DOMXPath($domDocument);

                $map            = null;
                $battleType     = null;
                $gameMode       = null;
                $spawn          = null;
                $result         = null;
                $battleDuration = null;
                $serverGameTime = null;
                $patch          = null;
                
                if (count($domxPath->query("//*[contains(@class, 'replay-stats__title')]")) > 0) {
                    // get text content of website
                    $result             = trim($domxPath->query("//*[contains(@class, 'replay-stats__title')]")->item(0)->textContent);
                    $mapAndBattleType   = trim($domxPath->query("//*[contains(@class, 'replay-stats__subtitle')]")->item(0)->textContent);
                    $spawnRaw           = trim($domxPath->query("//*[contains(@class, 'b-replay__img_wrap')]")->item(0)->textContent);
                    $replayInfo         = trim($domxPath->query("//*[contains(@class, 'replay__info clearfix')]")->item(0)->textContent);
                    $battleDurationRaw  = trim($domxPath->query("//*[contains(@class, 'replay-details__timings')]")->item(0)->textContent);                

                    // adjust raw text content
                    $map                = explode(' – ', $mapAndBattleType)[0];
                    $battleType         = explode(' – ', $mapAndBattleType)[1];
                    $spawnString        = explode(': ', $spawnRaw)[1];
                    $patch              = trim(explode('Server', trim(str_replace("\n", "", explode(':', $replayInfo)[1])))[0]);
                    $gameMode           = trim(explode('Battle type:', explode('Uploaded', $replayInfo)[0])[1]);
                    $duration           = str_replace(' s', '', str_replace(' min ', ':', trim(explode('duration', trim(str_replace("\n", "", explode('Time', $battleDurationRaw)[1])))[1])));
                    $battleDuration     = str_pad(explode(':', $duration)[0], 2, '0', STR_PAD_LEFT) . ':' . str_pad(explode(':', $duration)[1], 2, '0', STR_PAD_LEFT);
                    $serverGameTime     = Carbon::parse(trim(explode('Spawn:', explode('time:', $replayInfo)[1])[0]))->format('Y-m-d H:i:s');

                    $spawnString == 'I' ? $spawn = '1' : $spawn = '2'; 
                }

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
                $map        = null;
                $battleType = null;

                if ($battleStatistic['map']) {
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
                }

                BattleStatistic::create([
                    'map_id'            => $map->id ?? null,
                    'battle_type_id'    => $battleType->id ?? null,
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