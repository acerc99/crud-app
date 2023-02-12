<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;


class CityController extends Controller
{
    public function getCities(Request $request)
    {
        // dd(1);
        $stateId = $request->input('stateId');
        $cities = City::where('state_id', $stateId)->get();
        return response()->json($cities);
    }
}
