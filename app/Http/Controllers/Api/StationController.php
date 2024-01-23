<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enums\GovernmentType;
use App\Models\Enums\LandingPlatformSize;
use App\Models\Enums\StationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use OpenApi\Attributes as OA;

use App\Models\Station;
use Illuminate\Validation\Rule;

class StationController extends Controller
{

    #[OA\Get(
        path: '/api/stations',
        summary: 'Returns all stored stations in a paginated view',
        tags: ['Stations'],
        parameters: [
            new OA\Parameter(
                name: 'cursor',
                description: 'The cursor that was returned in the last request',
                in: 'query',
                schema: new OA\Schema(type: 'string'),
            ),
            new OA\Parameter(
                name: 'count',
                description: 'The number of stations per page. Maximum is 100. Defaults to 25',
                in: 'query',
                schema: new OA\Schema(type: 'integer')
            ),
            /*new OA\Parameter(
                name: 'commodity',
                description: 'If present, will enable commodity data on the stations',
                in: 'query',
                allowEmptyValue: true,

            )*/
            ],
            responses: [
                new OA\Response(
                    response: 200,
                    description: 'OK',
                    content: new OA\JsonContent(
                        type: 'object',
                        properties: [
                            new OA\Property(
                                property: 'data',
                                type: 'array',
                                items: new OA\Items(
                                    ref: '#/components/schemas/Station'
                                )
                            ),
                            new OA\Property(
                                property: 'per_page',
                                type: 'integer',
                                example: 10
                            ),
                            new OA\Property(
                                property: 'next_cursor',
                                type: 'string',
                            ),
                            new OA\Property(
                                property: 'next_page_url',
                                type: 'string',
                            ),
                            new OA\Property(
                                property: 'prev_cursor',
                                type: 'string',
                            ),
                            new OA\Property(
                                property: 'prev_page_url',
                                type: 'string',
                            ),
                        ]
                    )
                )
            ]
    )]
    public function index(Request $request) {

        $request->validate([
            'cursor' => ['string'],
            //'commodity' => [],
            'count' => ['integer']
        ]);

        $count = $count = min(100, $request->input('count', 25));
        $station_query = Station::orderBy('market_id');

        $station_paginator = $station_query->cursorPaginate($count);
        return response()->json([
            'data' => $station_paginator->items(),
            'per_page' => $station_paginator->perPage(),
            'next_cursor' => $station_paginator->nextCursor() ? $station_paginator->nextCursor()->encode() : null,
            'next_page_url' => $station_paginator->nextPageUrl() ? $station_paginator->nextPageUrl()."&count=$count" : null,
            'prev_cursor' => $station_paginator->previousCursor() ? $station_paginator->previousCursor()->encode() : null,
            'prev_page_url' => $station_paginator->previousPageUrl() ? $station_paginator->previousPageUrl()."&count=$count" : null,
        ]);

    }

    #[OA\Get(
        path: '/api/stations/search',
        summary: 'Searches for stations that meet the query',
        tags: ['Stations'],
        parameters: [
            new OA\Parameter(
                name: 'name',
                in: 'query',
                description: 'Name of the station'
            ),
            new OA\Parameter(
                name: 'radius',
                in: 'query',
                description: 'Allowed radius around {system_address}'
            ),
            new OA\Parameter(
                name: 'system_address',
                in: 'query',
                description: 'Searches for stations in the system and functions as center if {radius} is given. Required if {radius} is given'
            ),
            new OA\Parameter(
                name: 'faction',
                in: 'query',
                description: 'The faction name'
            ),
            new OA\Parameter(
                name: 'government',
                in: 'query',
                description: 'Stations with the corresponding government type',
                schema: new OA\Schema(type: 'string'),
                #ref: '#/components/schemas/GovernmentType'
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'data',
                            type: 'array',
                            items: new OA\Items(
                                ref: '#/components/schemas/Station'
                            )
                        ),
                        new OA\Property(
                            property: 'per_page',
                            type: 'integer',
                            example: 10
                        ),
                        new OA\Property(
                            property: 'next_cursor',
                            type: 'string',
                        ),
                        new OA\Property(
                            property: 'next_page_url',
                            type: 'string',
                        ),
                        new OA\Property(
                            property: 'prev_cursor',
                            type: 'string',
                        ),
                        new OA\Property(
                            property: 'prev_page_url',
                            type: 'string',
                        ),
                    ]
                )
            )
        ]
    )]
    public function search(Request $request) {

        $request->validate([
            'cursor' => ['string'],
            'name' => ['string'],
            'radius' => ['integer', 'required_with:center'],
            'system_address' => ['integer'],
            'faction' => ['string'],
            'government' => ['string']
        ]);

        // Raise a 502 "Not Implemented" if radius parameter is present
        if ($request->has('radius')) {
            return response()->json([
                'error' => 501,
                'message' => 'Station search by radius is not implemented yet. Please refer to the documentation at '.env('APP_URL').'/api/documentation'
            ], 501);
        } else {
            $station_query = Station::query();
        }

        if ($request->has('system_address') && !$request->has('radius')) {
            $station_query->where('system_address', $request->input('system_address'));
        }

        if ($request->has('name')) {
            $station_query->where('name', 'like', '%'.$request->input('name').'%');
        }

        // Paginate and return the result
        $station_paginator = $station_query->cursorPaginate(50);

        return response()->json([
            'data' => $station_paginator->items(),
            'per_page' => $station_paginator->perPage(),
            'next_cursor' => $station_paginator->nextCursor(),
            'next_page_url' => $station_paginator->nextPageUrl(),
            'prev_cursor' => $station_paginator->previousCursor(),
            'prev_page_url' => $station_paginator->previousPageUrl(),
        ]);

    }

    #[OA\Get(
        path: '/api/station/{market_id}',
        summary: 'Returns all stored information about the station',
        tags: ['Stations'],
        parameters: [
            new OA\Parameter(
                name: 'market_id',
                in: 'path',
                required: true,
                description: 'The market ID of the station'
            )
            ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Station'
                )
            )
        ]
    )]
    public function get(Request $request, $marketId) {

        $station_query = Station::where('market_id', $marketId);

        if($station_query->exists()) {
            return response()->json($station_query->get()[0], 200);
        } else {
            return response()->json([
                "error" => 404,
                "message" => "Station not found"
            ], 404);
        }

    }

    #[OA\Post(
        path: '/api/station/{market_id}',
        summary: 'Updates a station',
        description: 'Updates the station data. Requires an API-Key that is only available for trusted providers',
        tags: ['Stations'],
        parameters: [
            new OA\Parameter(
                name: 'market_id',
                in: 'path',
                required: true,
                description: 'The market Id of the >i< station'
            ),
        ],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                ref: '#/components/schemas/Station'
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Returns the updated station',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Station'
                )
            )
        ]
    )]
    public function update(Request $request, int $market_id) {

        // Validate the request data
        $validated_data = $request->validate([
            'name' => ['string', 'required'],

            'system_address' => ['integer', 'required'],
            'distance_from_star' => ['decimal:0,6', 'required'],
            'landing_platform_size' => [Rule::enum(LandingPlatformSize::class), 'required'],
            'station_type' => [Rule::enum(StationType::class), 'required'],

            'station_economies' => ['array'],
            'station_economies.*' => ['array:name,proportion'],
            'station_economies.*.name' => ['string', 'required'],
            'station_economies.*.proportion' => ['decimal:0,4', 'max:1.0', 'required'],

            'station_government' => [Rule::enum(GovernmentType::class), 'required'],

            'station_faction' => ['array:name,state', 'required'],
            'station_faction.name' => ['string', 'required'],
            'station_faction.state' => ['string', 'required']
        ]);

        // Search for station
        $station = Station::where('market_id', $market_id)->first();

        // If stations does not exist, add it
        if (!$station) {
            // Create new Station instance, this data can't be changed unless Admin does it


            /* If Bernal is sended, store Orbis, as it is the new name of it */
            $station_type = $validated_data['station_type'];

            if ($station_type == StationType::BERNAL->value) {
                $station_type = StationType::ORBIS->value;
            }

            $station = new Station([
                'market_id' => $market_id,
                'system_address' => $validated_data['system_address'],
                'distance_from_star' => $validated_data['distance_from_star'],
                'landing_platform_size' => $validated_data['landing_platform_size'],
                'station_type' => $station_type,
                'system_address' => $validated_data['system_address'],
            ]);
        }

        // Set data of the station that can updated
        $station->name = $validated_data['name'];
        $station->station_economies = $validated_data['station_economies'];
        $station->station_government = $validated_data['station_government'];
        $station->station_faction = $validated_data['station_faction']['name'];

        // Save the station to the database
        if (!$request->has('test')) {
            $station->save();
        }

        // Return a successfull response with the station model as a response
        return response()->json([
            'status' => 200,
            'message' => 'Updating station was successfull',
            'data' => $station
        ], 200);

    }

    #[OA\Get(
        path: '/api/station/{market_id}/commodity',
        summary: 'Returns the commodity data for the specified station',
        tags: ['Stations'],
        parameters: [
            new OA\Parameter(
                name: 'market_id',
                in: 'path',
                required: true,
                description: 'The market ID of the station'
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        ref:"#/components/schemas/Commodity"
                    )
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Station not found',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'error',
                            type: 'string',
                            example: 404
                        ),
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'No station matching this market ID'
                        )
                    ]
                )
            )
        ]
    )]
    public function getCommodity(Request $request, $market_id) {

        $station_query = Station::where('market_id', $market_id);

        if(!$station_query->exists()) {
            return response()->json([
                'error' => 404,
                'message' => 'No station matching this market ID'
            ], 404);
        }

        $station = $station_query->first();

        return response()->json($station->commodity);

    }

    #[OA\Post(
        path: '/api/station/{market_id}/commodity',
        summary: 'Updates the commodity data for the specified station',
        description: 'Updates the commodity data for the specified station. Requires an API-Key that is only available for trusted providers',
        tags: ['Stations'],
        parameters: [
            new OA\Parameter(
                name: 'market_id',
                in: 'path',
                required: true,
                description: 'The market ID of the station'
            )
        ],
        requestBody: new OA\RequestBody(
            content: new OA\JsonContent(
                type: 'array',
                items: new OA\Items(
                    ref: '#/components/schemas/Commodity'
                )
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'OK',
                content: new OA\JsonContent(
                    type: 'array',
                    items: new OA\Items(
                        ref:"#/components/schemas/Commodity"
                    )
                )
            ),
            new OA\Response(
                response: 404,
                description: 'Station not found',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(
                            property: 'error',
                            type: 'string',
                            example: 404
                        ),
                        new OA\Property(
                            property: 'message',
                            type: 'string',
                            example: 'No station matching this market ID'
                        )
                    ]
                )
            )
        ]
    )]
    public function updateCommodity(Request $request, $market_id) {

        $station = Station::where('market_id', $market_id);


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

            foreach ($validated['commodity'] as $commodity) {
                $station_commodity = $station->commodity()->firstOrNew([
                    'name' => $commodity['name'],
                ]);
                $station_commodity->buy_price = $commodity['buy_price'];
                $station_commodity->sell_price = $commodity['sell_price'];
                $station_commodity->demand = $commodity['demand'];
                $station_commodity->stock = $commodity['stock'];
                $station->commodity()->save($station_commodity);
                $station_commodity->save();
                }

            return response()->json([
                "status" => 200,
                "message" => "Updating commodities was successfull",
                "data" => $station->commodity
            ], 200);
        } else {
            return response()->json([
                "error" => 404,
                "message" => "No station matching this market ID"
            ], 404);
        }

    }

}
