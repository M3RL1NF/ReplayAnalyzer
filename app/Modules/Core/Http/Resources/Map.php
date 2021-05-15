<?php

namespace App\Modules\Core\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Map extends JsonResource
{
    public function toArray($request)
    {
        // not used
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
