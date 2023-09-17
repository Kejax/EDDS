<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
            return response()->json($station->get()[0], 200);
        } else {
            return response()->json([
                "error" => 404,
                "message" => "Station not found"
            ], 404);
        }

    }

    public function search(Request $request) {

        $systemAddress = $request->input('systemAddress');
        $name = $request->input('name');
        
        $systemDistance = $request->input('systemDistance');
        $centerSystem = $request->input('centerSystem');

        // Check if any parameters are present, if not: return 400
        if ($request->hasAny(['systemAddress', 'name', 'systemDistance', 'centerSystem']))

        // Check if query param 'systemAddress is of type integer, otherwise return a client error
        if (!is_int($systemAddress)) {
            return response()->json([
                "error" => 400,
                "message" => "Query parameter 'systemAdress' is not a valid integer ID"
            ], 400);
        }

        // Check if query param 'systemDistance' is of type integer, otherwise return a client error
        if (!is_int($systemDistance)) {
            return response()->json([
                "error" => 400,
                "message" => "Query parameter 'systemDistance' is not a valid integer"
            ], 400);
        }

        // Get a new Query for Station
        $stationQuery = Station::query();

        // Check if query param 'systemAdress' is given and add it to the query
        if ($systemAddress != null) {
            $stationQuery->where('systemAddress', $systemAddress);
        }

        // Check if query param 'name' is given and add it to the query
        if ($name != null) {
            $stationQuery->where('name', 'like', $name);
        }

        // Check if query param 'currentSystem' is given and query param 'systemDistance'
        if ($centerSystem != null && $systemAddress == null) {

            if ($systemDistance != null) {
                /*$stationQuery->whereRaw(''); /* TODO Check EDSM.NET for a suitable api endpoint that can return systems
                in range of another system */

                // Get the nearest systems to the currentLocation or 
                $bubbleJson = Http::get("https://www.edsm.net/api-v1/sphere-systems?systemId64=$centerSystem&radius=$distance&showId=1");


                $stationQuery = $stationQuery->where(function (Builder $query) {
                    foreach($bubbleJson as $bubbleSystem) {
                        $query = $query->orWhere('systemAddress', $bubbleSystem['id64']);
                    }
                });

            }

        }

        if(!empty($station)) {
            return response()->json([
                $station
            ]);                                                        
        }

    }

    public function update(Request $request) {

    }

    public function updateCommodity(Request $request, $marketId) {

        $station = Station::where('marketId', $marketId);


        $validated = $request->validate([
            "commodity.*.buyPrice" => 'required|int',
            "commodity.*.sellPrice" => 'required|int',
            "commodity.*.demand" => 'required|int',
            "commodity.*.stock" => 'required|int',
            "commodity.*.name" => 'required|int'
        ]);

        if($station->exists()) {
            $station = $station->first();
            $station->commodity = $validated['commodity'];
            $station->save();

            response()->json([
                "message" => "update successfull",
                "code" => 200,
                "data" => json_encode($station->commodity)
            ], 200);
        } else {
            response()->json([
                "error" => 404,
                "message" => "No station matching this market ID"
            ], 404);
        }

    }

}
