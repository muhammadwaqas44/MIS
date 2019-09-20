<?php

namespace App\Http\Controllers;

use App\CallStatus;
use App\Designation;
use App\ExpCategory;
use Illuminate\Http\Request;
use DB;

class DropdownController extends Controller
{
    public function getStateList(Request $request)
    {
        $states = DB::table("states")
            ->where("country_id", $request->country_id)
            ->pluck("name", "id");
        return response()->json($states);
    }

    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")
            ->where("state_id", $request->state_id)
            ->pluck("name", "id");
        return response()->json($cities);
    }

    public function getCallStatusList(Request $request)
    {
        $callStatuses = CallStatus::where("parent_id", $request->parent_id)
            ->pluck("name", "id");
        return response()->json($callStatuses);
    }

    public function getDesignationList(Request $request)
    {
        $designations = Designation::where("department_id", $request->department_id)
            ->pluck("name", "id");
        return response()->json($designations);
    }

    public function getCategoryList(Request $request)
    {
        $categories= ExpCategory::where("exp_type_id", $request->exp_type_id)
            ->pluck("name", "id");
        return response()->json($categories);
    }
}
