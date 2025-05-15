<?php

namespace App\Http\Resources;

use App\Models\Place;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $start = Carbon::parse($this->departure_time);
        $end = Carbon::parse($this->arrival_time);
        $travel_time = $start->diff($end)->format('%H:%I:%S');

        $from_place = Place::query()->find($this->from_place_id);
        $to_place = Place::query()->find($this->to_place_id);

        return [
            'id' => $this->id,
            'line' => $this->line,
            'departure_time' => $this->departure_time,
            'arrival_time' => $this->arrival_time,
            'travel_time' => $travel_time,
            'from_place' => [
                'id' => $from_place->id,
                'name' => $from_place->name,
                'type' => $from_place->type,
                'longitude' => $from_place->longitude,
                'latitude' => $from_place->latitude,
                'x' => $from_place->x,
                'y' => $from_place->y,
                'open_time' => $from_place->open_time,
                'close_time' => $from_place->close_time,
                'description' => $from_place->description,
                'image_path' => $from_place->image_path
            ],
            'to_place' => [
                'id' => $to_place->id,
                'name' => $to_place->name,
                'type' => $to_place->type,
                'longitude' => $to_place->longitude,
                'latitude' => $to_place->latitude,
                'x' => $to_place->x,
                'y' => $to_place->y,
                'open_time' => $to_place->open_time,
                'close_time' => $to_place->close_time,
                'description' => $to_place->description,
                'image_path' => $to_place->image_path
            ]
        ];
    }
}
