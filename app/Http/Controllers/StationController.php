<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Station;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StationController extends Controller
{
    public function index() {
        $stations = Station::all();
        return response()->json($stations);
    }

    public function get(Request $request, $marketId) {

        $station = Station::where('market_id', $marketId);
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


                /*$stationQuery = $stationQuery->where(function (Builder $query) {
                    foreach($bubbleJson as $bubbleSystem) {
                        $query = $query->orWhere('systemAddress', $bubbleSystem['id64']);
                    }
                });*/

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

        $station = Station::where('market_id', $marketId);


        $validated = $request->validate([
            "commodity.*.buy_price" => 'required|int',
            "commodity.*.sell_price" => 'required|int',
            "commodity.*.demand" => 'required|int',
            "commodity.*.stock" => 'required|int',
            "commodity.*.name" => 'required|string',
        ]);

        if($station->exists()) {
            $station = $station->first();
            $station->save();

            $toReturn = array();

            foreach ($validated['commodity'] as $commodity) {
                $station_commodity = $station->commodities()->where('name', $commodity['name'])->first();
                if ($station_commodity == null) {
                    $station_commodity = new Commodity();
                    $station_commodity->name = $commodity['name'];
                    $station_commodity->buy_price = $commodity['buy_price'];
                    $station_commodity->sell_price = $commodity['sell_price'];
                    $station_commodity->demand = $commodity['demand'];
                    $station_commodity->stock = $commodity['stock'];
                    $station->commodities()->save($station_commodity);
                } else {
                    $station_commodity->buy_price = $commodity['buy_price'];
                    $station_commodity->sell_price = $commodity['sell_price'];
                    $station_commodity->demand = $commodity['demand'];
                    $station_commodity->stock = $commodity['stock'];
                    $station_commodity->save();
                }
                array_push($toReturn, $station_commodity);
            }

            return response()->json([
                "message" => "Updating commodities was successfull",
                "code" => 200,
                "data" => $toReturn
            ], 200);
        } else {
            return response()->json([
                "error" => 404,
                "message" => "No station matching this market ID"
            ], 404);
        }

    }

}
