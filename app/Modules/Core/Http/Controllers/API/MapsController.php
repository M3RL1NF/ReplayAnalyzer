<?php

namespace Modules\Core\Http\Controllers\API;

use App\Models\Map;
use App\Modules\Core\Http\Resources\Map as MapResource;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MapsController extends Controller
{
    public function index()
    {
        return response()->json([
            'maps' => Map::orderBy('name')->get()
        ]);
    }
}
