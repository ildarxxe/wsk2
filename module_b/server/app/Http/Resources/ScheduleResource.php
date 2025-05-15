<?php

namespace App\Http\Resources;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $from_place = Place::query()->find($this->from_place_id)->name;
        $to_place = Place::query()->find($this->to_place_id)->name;
        return [
            'line' => $this->line,
            'from_place' => $from_place,
            'to_place' => $to_place,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'distance' => $this->distance,
            'speed' => $this->speed,
            'status' => $this->status
        ];
    }
}
