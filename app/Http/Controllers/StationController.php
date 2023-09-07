<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Station;

class StationController extends Controller
{
    public function index() {
        $stations = Station::all();
        return response()->json($stations);
    }

    public function get(Request $request, $marketId) {
        
        $station = Station::where('marketId', $marketId);
        if($station->exists()) {
            return response()->json($station->get()[0]);
        } else {
            return response()->json([
                "error" => 404,
                "message" => "Station not found"
            ]);
        }

    }

    public function search(Request $request, $query) {

        $station = Station::find($query); // TODO Change for finding several query fitting stations
        if(!empty($station)) {
            return response()->json([
                $station
            ]);                                                        
        }

    }

}
