<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

use App\Models\System;
use App\Models\Enums\EconomyType;
use App\Models\Enums\GovernmentType;
use App\Models\Enums\SecurityLevel;
use Illuminate\Validation\Rule;

class SystemController extends Controller
{
    #[OA\Post(
        path: '/api/system/{system_id}',
        summary: 'Updates data of a certain system',
        tags: ['Systems'],
        parameters: [
            new OA\Parameter(
                name: 'system_id',
                in: 'path',
                description: 'The system Id64 for the system'
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',

            )
        ]
    )]
    public function update(Request $request, $systemAddress) {

        // TODO Rewrite Station update controller
        // TODO Swagger Docs (Finish)

        $validated_data = $request->validate([
            'name' => ['string', 'required'],
            'star_position_x' => ['decimal:0,2'],
            'star_position_y' => ['decimal:0,2'],
            'star_position_z' => ['decimal:0,2'],
            'system_economy' => [Rule::enum(EconomyType::class)],
            'system_second_economy' => [Rule::enum(EconomyType::class)],
            'system_government' => [Rule::enum(GovernmentType::class)],
            'system_security' => [Rule::enum(SecurityLevel::class)],
            'population',
        ]);


        // Old Code

        $system = System::firstOrNew([
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
