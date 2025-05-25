<?php

namespace App\Http\Controllers\api\v1\schedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
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
            return response()->json(['Message' => 'schedules not found'], 404);
        }
        return response()->json(ScheduleResource::collection($schedules));
    }

    public function createSchedule(CreateScheduleRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            Schedule::query()->create($data);
            return response()->json(['Message' => 'create success']);
        } catch (\Exception $exception) {
            return response()->json(['message' => 'Data cannot be processed'], 422);
        }
    }

    public function updateSchedule(UpdateScheduleRequest $request, $id): JsonResponse {
        $data = $request->validated();
        try {
            $schedule = Schedule::query()->findOrFail($id);
            $schedule->update($data);
            $schedule->save();
            return response()->json(['Message' => 'update success']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Data cannot be updated'], 400);
        }
    }

    public function deleteSchedule($id): JsonResponse {
        $schedule = Schedule::query()->findOrFail($id);
        $schedule->delete();
        return response()->json(['Message' => 'delete success']);
    }
}
