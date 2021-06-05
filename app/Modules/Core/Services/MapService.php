<?php

namespace Modules\Core\Services;

use App\Models\BattleStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MapService
{
    public static function evaluate(Request $request)
    {
        $battleStatistics   = BattleStatistic::where('map_id', $request->input('mapId'))->get();

        Log::info($request->input('mapId'));

        $patches            = self::getPatches($battleStatistics);

        $gameModes          = self::getGameModes($battleStatistics);

        $battleResults      = self::getBattleResults($battleStatistics, $patches, $gameModes);

        Log::info($battleResults);

        return $battleResults;
    }

    public static function getPatches($battleStatistics)
    {
        $uniquePatches      = $battleStatistics->unique('patch');
        $patches            = [];

        foreach ($uniquePatches as $patch) {
            $patches[]      = $patch->patch;
        }

        return $patches;
    }

    public static function getGameModes($battleStatistics)
    {
        $uniqueGameModes    = $battleStatistics->unique('game_mode');
        $gameModes          = [];

        foreach ($uniqueGameModes as $gameMode) {
            $gameModes[]      = $gameMode->game_mode;
        }

        return $gameModes;
    }

    public static function getBattleResults($battleStatistics, $patches, $gameModes)
    {
        foreach ($patches as $patch) {
            foreach ($gameModes as $gameMode) {
                $battleStats            = $battleStatistics->where('patch', $patch)->where('game_mode', $gameMode);

                if ($battleStats->count() > 0) {
                    $games              = $battleStats->count();

                    $draws              = $battleStats->where('result', 'Draw')->count();

                    $victorysSpawn1     = $battleStats->where('result', 'Victory')->where('spawn', '1')->count();

                    $defeatsSpawn2      = $battleStats->where('result', 'Defeat')->where('spawn', '2')->count();

                    $drawRate           = number_format((float)$draws / $games * 100, 2, '.', '');

                    $winRateSpawn1      = number_format((float)((($victorysSpawn1 / $games) + ($defeatsSpawn2 / $games)) * 100), 2, '.', '');

                    $winRateSpawn2      = number_format((float)(100 - $drawRate - $winRateSpawn1), 2, '.', '');

                    $duration           = '???';

                    $results[$patch][$gameMode][] = [
                        'games'         => $games,
                        'draws'         => $drawRate,
                        'winsSpawn1'    => $winRateSpawn1, 
                        'winsSpawn2'    => $winRateSpawn2,
                        'duration'      => $duration
                    ];
                }
            }
        }

        return $results;
    }
}