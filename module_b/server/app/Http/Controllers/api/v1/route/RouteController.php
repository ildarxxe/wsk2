<?php

namespace App\Http\Controllers\api\v1\route;

use App\Http\Controllers\Controller;
use App\Http\Resources\RouteResource;
use App\Http\Resources\ScheduleResource;
use App\Models\RouteSearch;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function searchRoutes($from_place_id, $to_place_id, $departure_time = null): JsonResponse
    {
        $time = Carbon::parse($departure_time)->format('H:i:s') ?? Carbon::now()->format('H:i:s');
        $routes = Schedule::query()
            ->where('from_place_id', $from_place_id)
            ->where('to_place_id', $to_place_id)
            ->whereTime('departure_time', '>=', $time)
            ->orderBy('departure_time')
            ->limit(5)
            ->get();
        if ($routes->isEmpty()) {
            return response()->json(['Message' => 'Route not found'], 404);
        }

        return response()->json(RouteResource::collection($routes));
    }

    public function saveRouteSelection(Request $request): JsonResponse
    {
        $data = $request->validate([
            'from_place_id' => 'required',
            'to_place_id' => 'required',
            'schedule_ids' => 'required',
        ]);

        try {
            foreach ($data['schedule_ids'] as $schedule_id) {
                RouteSearch::query()->create([
                    'schedule_id' => $schedule_id,
                    'from_place_id' => $data['from_place_id'],
                    'to_place_id' => $data['to_place_id'],
                ]);
            }
            return response()->json(['Message' => 'create success']);
        } catch (\Exception $exception) {
            return response()->json(['Message' => 'Data cannot be processed'], 422);
        }
    }
}
