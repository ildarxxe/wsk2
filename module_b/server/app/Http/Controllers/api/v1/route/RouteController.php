<?php

namespace App\Http\Controllers\api\v1\route;

use App\Http\Controllers\Controller;
use App\Http\Resources\RouteResource;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class RouteController extends Controller
{
    public function getRoute($from_place_id, $to_place_id, $departure_time = null): JsonResponse
    {
        $time = Carbon::parse($departure_time)->format('H:i:s') ?? Carbon::now()->format('H:i:s');
        $schedules = Schedule::query()
            ->where('from_place_id', $from_place_id)
            ->where('to_place_id', $to_place_id)
            ->whereTime('departure_time', '>=', $time)
            ->orderBy('departure_time')
            ->get();
        if (!$schedules) {
            return response()->json(['status' => false, 'Message' => 'Schedule not found'], 404);
        }
        return response()->json(['res' => RouteResource::collection($schedules)]);
    }
}
