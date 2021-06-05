<?php

namespace Modules\Core\Http\Controllers\API;

use App\Models\Map;
use App\Modules\Core\Http\Resources\Map as MapResource;
use Modules\Core\Services\MapService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class MapsController extends Controller
{
    public function getMaps()
    {
        return response()->json([
            'maps' => Map::orderBy('name')->get()
        ]);
    }

    public function getMap(Request $request)
    {
        return MapService::evaluate($request);
    }
}
