<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\System;

class SystemController extends Controller
{
    // TODO

    public function update(Request $request, $systemAddress) {

        $system = System::firstOrCreate([
            'systemAddress' => $systemAddress
        ]);

        $system->name = $request->name;

        $system->systemAddress = $request->systemAddress;
        $system->starPositionX = $request->starPositionX;
        $system->starPositionY = $request->starPositionY;
        $system->starPositionZ = $request->starPositionZ;

        $system->systemAllegiance = $request->systemAllegiance;
        $system->systemEconomy = $request->systemEconomy;
        $system->systemGovernment = $request->systemGovernment;
        $system->systemSecurity = $request->systemSecurity;
        $system->population = $request->population;
        $system->factions = $request->factions;

        foreach($request->marketIds as $marketId) {
            if (!in_array($marketId, $system->marketIds)) {
                $system->marketIds->push($marketId);
            }
        }

        $system->save();

        return response()->json([
            "message" => "Update success",
            "data" => $system->toArray()
        ]);

    }

}
