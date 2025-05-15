<?php

namespace app\Http\Controllers\api\v1\place;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Models\Place;
use App\Services\CreatePoi\PoiFactoryService;
use App\Services\CreateTarget\CreateTargetService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Random\RandomException;

class PlaceController extends Controller
{
    public function getAllPlaces(): JsonResponse
    {
        $places = Place::all();
        if (!$places) {
            return response()->json(['status' => false, 'err_msg' => 'places not found']);
        }
        return response()->json(['status' => true, 'data' => $places]);
    }

    /**
     * @throws RandomException
     */
    public function getPlaceById($id): JsonResponse
    {
        $place = Place::query()->find($id);
        if (!$place) {
            return response()->json(['status' => false, 'err_msg' => 'place not found']);
        }
        $place['num_searches'] = random_int(1,100);
        return response()->json(['status' => true, 'place' => $place]);
    }

    public function createPlace(PlaceRequest $request): JsonResponse
    {
        $data = $request->validated();

        if (!$data) {
            return response()->json(['status' => false, 'Message' => 'Data cannot be processed']);
        }

        DB::beginTransaction();
        try {
            $image = $data['image'];
            $image_name = $image->getClientOriginalName();
            $path = $image->storeAs('images', $image_name);
            $data['image_path'] = Storage::url($path);
            unset($data['image']);

            $target = ['latitude' => CreateTargetService::randomFloat(0, 90), 'longitude' => CreateTargetService::randomFloat(0, 180)];
            $poiFactoryService = new PoiFactoryService($start = ['latitude' => 13.772478, 'longitude' => 100.482653], $end = ['latitude' => 13.736280, 'longitude' => 100.536051], $width = 1280, $height = 800);
            $coordinates = $poiFactoryService->calculate($target);
            $data['x'] = (int)$coordinates['x'];
            $data['y'] = (int)$coordinates['y'];

            Place::query()->create($data);
            DB::commit();

            return response()->json(['status' => true, 'Message' => 'create success']);
        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($path)) {
                Storage::delete($path);
            }
            return response()->json(['status' => false, 'err_msg' => $e->getMessage()], 500);
        }
    }

    public function updatePlace(Request $request, $id): JsonResponse
    {
        $place = Place::query()->find($id);
        if (!$place) {
            return response()->json(['status' => false, 'err_msg' => 'place not found']);
        }

        $data = $request->all();
        try {
            $place->update($data);
            $place->save();
            return response()->json(['status' => true, 'Message' => 'update success', 'data' => $request->all()]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'Message' => 'Data cannot be updated'], 400);
        }
    }

    public function deletePlace($id): JsonResponse {
        $place = Place::query()->find($id);
        $image_path = $place->image_path;
        try {
            Storage::disk('public')->delete($image_path);
            $place->delete();
            return response()->json(['status' => true, 'Message' => 'delete success']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'Message' => 'Data cannot be deleted'], 400);
        }
    }
}
