<?php

namespace App\Http\Controllers\api\v1\schedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Models\Schedule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function getAllSchedules(): JsonResponse
    {
        $schedules = Schedule::all();
        if (!$schedules) {
            return response()->json(['status' => false, 'Message' => 'No schedules found.'], 404);
        }
        return response()->json(['status' => true, 'data' => ScheduleResource::collection($schedules)]);
    }

    public function createSchedule(ScheduleRequest $request): JsonResponse {
        $data = $request->validated();
        try {
            Schedule::query()->create($data);
            return response()->json(['status' => true, 'message' => 'create success']);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'Message' => 'Data cannot be processed'], 422);
        }
    }

    public function updateSchedule(Request $request, $id): JsonResponse {
        $data = $request->all();
        $schedule = Schedule::query()->find($id);
        if (!$schedule) {
            return response()->json(['status' => false, 'Message' => 'Schedule not found.'], 404);
        }
        try {
            $schedule->update($data);
            $schedule->save();
            return response()->json(['status' => true, 'message' => 'update success']);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'Message' => 'Data cannot be processed'], 400);
        }
    }

    public function deleteSchedule($id): JsonResponse {
        $schedule = Schedule::query()->find($id);
        if (!$schedule) {
            return response()->json(['status' => false, 'Message' => 'Schedule not found.'], 404);
        }
        try {
            $schedule->delete();
            return response()->json(['status' => true, 'message' => 'delete success']);
        } catch (\Exception $exception) {
            return response()->json(['status' => false, 'Message' => 'Data cannot be processed'], 422);
        }
    }
}
