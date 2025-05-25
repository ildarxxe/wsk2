<?php

namespace App\Http\Controllers\api\v1\place;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Models\Place;
use App\Models\RouteSearch;
use App\Models\Schedule;
use App\Services\Poi\PoiFactoryService;
use App\Services\Poi\PoiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    public function getAllPlaces(): JsonResponse
    {
        $places = Place::all();
        if ($places->isEmpty()) {
            return response()->json(['message' => 'places not found'], 404);
        }

        return response()->json([$places]);
    }

    public function getPlaceById($id): JsonResponse
    {
        $place = Place::query()->findOrFail($id);
        $num_searches = RouteSearch::query()->where('from_place_id', $id)->orWhere('to_place_id', $id)->count();
        $place['num_searches'] = $num_searches;
        unset($place['id']);
        return response()->json($place);
    }

    public function createPlace(CreatePlaceRequest $request): JsonResponse
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $image = $data['image'];
            $image_name = $image->getClientOriginalName();
            $image_path = $image->storeAs('images', $image_name, 'public');

            $data['image_path'] = $image_path;
            unset($data['image']);

            $target = ['latitude' => $data['latitude'], 'longitude' => $data['longitude']];
            $poiService = new PoiFactoryService();
            $calc = $poiService->calculate($target);

            $data['x'] = $calc['x'];
            $data['y'] = $calc['y'];

            Place::query()->create($data);
            DB::commit();
            return response()->json(['Message' => 'create success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['Message' => 'Data cannot be created'], 422);
        }
    }

    public function updatePlace($id, UpdatePlaceRequest $request): JsonResponse {
        $data = $request->validated();

        $place = Place::query()->findOrFail($id);

        DB::beginTransaction();
        try {
            if ($data['image']) {
                $old_image = $place->image_path;
                Storage::delete($old_image);

                $image = $data['image'];
                $image_name = $image->getClientOriginalName();
                $image_path = $image->storeAs('images', $image_name, 'public');
                $data['image_path'] = $image_path;
                unset($data['image']);
            }

            if (isset($data['longitude']) || isset($data['latitude'])) {
                $target = ['latitude' => $data['latitude'] ?? $place->latitude, 'longitude' => $data['longitude'] ?? $place->longitude];
                $poiService = new PoiFactoryService();
                $calc = $poiService->calculate($target);

                $data['x'] = $calc['x'];
                $data['y'] = $calc['y'];
            }

            $place->update($data);
            DB::commit();
            return response()->json(['Message' => 'update success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['Message' => 'Data cannot be updated'], 400);
        }
    }

    public function deletePlace($id): JsonResponse {
        $place = Place::query()->findOrFail($id);
        DB::beginTransaction();
        try {
            $image_path = $place->image_path;
            Storage::delete($image_path);
            Schedule::query()->where('from_place_id', $id)->orWhere('to_place_id', $id)->delete();
            $place->delete();
            DB::commit();
            return response()->json(['Message' => 'delete success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['Message' => 'Data cannot be deleted'], 400);
        }
    }
}
