<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>

    </head>

    <style>
        h3 {
            line-height: 20px
        }
    </style>

    <body>
        <main class="m-5">
            <h1 class="text-3xl mb-5">Kejax's EDDB API Documentation</h1>

            <div class="mb-5">

                <h2 class="text-2xl">DISCLAIMER</h2>

                <p>This documentation is purely used for development and will be updated when I'm adding new endpoints to the development version of this API</p>

                <p>If the API at [https://eddb.kejax.net](https://eddb.kejax.net) is behaving differently than documented here,
                check that the current API version is the same as at [https://eddb.kejax.net/api/documentation](https://eddb.kejax.net/api/documentation)!!!</p>
            </div>

            <div class="mb-5">
                <h2 class="text-2xl mb-3">Endpoints</h2>

                <!-- /api/station/{market_id} GET -->
                <div class="mb-3 p-2 border-2 border-black rounded-lg">
                    <h3 class="text-xl mb-2">
                        /api/station/{market_id}
                        <div class="bg-green-600 rounded-lg inline-block text-[20px] text-white p-1">GET</div>
                    </h3>

                    Returns the data of the station, defined by it's market ID
                </div>

                <!-- /api/station/{market_id} POST -->
                <!--<div class="mb-3 p-2 border-2 border-black rounded-lg">
                    <h3 class="text-xl mb-2">
                        /api/station/{market_id}
                        <div class="bg-blue-600 rounded-lg inline-block text-[20px] text-white p-1">POST</div>
                    </h3>

                    Updates a the data stored about a station. Used for internal purposes only, requires an authorization header
                </div>-->

                <!-- /api/station/{market_id}/commodity GET -->
                <div class="mb-3 p-2 border-2 border-black rounded-lg">
                    <h3 class="text-xl mb-2">
                        /api/station/{market_id}/commodity
                        <div class="bg-green-600 rounded-lg inline-block text-[20px] text-white p-1">GET</div>
                    </h3>

                    Returns the commodity data for the specified station
                </div>

                <!-- /api/station/{market_id}/commodity POST -->
                <!--<div class="mb-3 p-2 border-2 border-black rounded-lg">
                    <h3 class="text-xl mb-2">
                        /api/station/{market_id}/commodity
                        <div class="bg-blue-600 rounded-lg inline-block text-[20px] text-white p-1">POST</div>
                    </h3>

                    Updates commodity data for the specified station. Used for internal purposes only, requires an authorization header
                </div>-->

                <!-- /api/stations GET -->
                <div class="mb-3 p-2 border-2 border-black rounded-lg">
                    <h3 class="text-xl mb-2">
                        /api/stations
                        <div class="bg-green-600 rounded-lg inline-block text-[20px] text-white p-1">GET</div>
                    </h3>

                    Get all stations that are stored in a paginated view.<br>
                    50 stations per page
                    <h4 class="text-lg">Response:</h4>
                    <ul class="ml-5">
                        <li>"data" | A list of [StationObject]</li>
                        <li>"per_page" | The amount of [StationObject]s per page</li>
                        <li>"next_cursor" | The cursor for the next page</li>
                        <li>"next_page_url" | The url for the next page</li>
                        <li>"prev_cursor" | The cursor for the previous page</li>
                        <li>"prev_page_url" | The url for the previous page</li>
                    </ul>
                </div>

                <!-- /api/stations/search GET -->
                <div class="mb-3 p-2 border-2 border-black rounded-lg">
                    <h3 class="text-xl mb-2">
                        /api/stations/search
                        <div class="bg-green-600 rounded-lg inline-block text-[20px] text-white p-1">GET</div>
                    </h3>

                    Search for a station with the given parameters in a paginated view<br>
                    50 stations per page

                    <h4 class="text-lg">Response:</h4>
                    <ul class="ml-5">
                        <li>"cursor" | The cursor string that was returned by the first request</li>
                        <li>"name" | Filter for all stations that are similar or contain "name"</li>
                        <li>"radius" | The radius for stations around the specified system.
                            (This is not implemented yet and will raise a "501 - Not Implemented" error)
                        </li>
                        <li>"center" | The center for the "radius" search required if radius is given (Not implemented yet)</li>
                        <li>"faction" | The name of the faction that's controlling the station (Not implemented yet)</li>
                        <li>"government" | The government type of the station (Not implemented yet)</li>
                    </ul>

                    <h4 class="text-lg">Response:</h4>
                    <ul class="ml-5">
                        <li>"data" | A list of [StationObject]</li>
                        <li>"per_page" | The amount of [StationObject]s per page</li>
                        <li>"next_cursor" | The cursor for the next page</li>
                        <li>"next_page_url" | The url for the next page</li>
                        <li>"prev_cursor" | The cursor for the previous page</li>
                        <li>"prev_page_url" | The url for the previous page</li>
                    </ul>
                </div>
            </div>

            <div class="mb-5">

                <h2 class="text-2xl mb-3">Models</h2>

                <div class="mb-3 p-2 border-2 border-black rounded-lg">

                    <h3 class="text-xl mb-2">
                        StationObject
                    </h3>

                    <ul class="ml-5">
                        <li>"market_id" - int | The Market-ID of the station</li>
                        <li>"name" - string | The stations name</li>
                        <li>"system_address" - int | The ID64 for the stations system</li>
                        <li>"distance_from_star" decimal | The distance from the star</li>
                        <li>"landing_platform_size" - int | The size of the biggest landing platform (0 = small, 1 = middle, 2 = big)</li>
                        <li>"station_type" - enum[StationType] | The type of the station</li>
                        <li>"station_economies" list | List of object that contain the following data:</li>
                        <ul class="ml-5">
                            <li>- "name" - string | The economy identifier (Subject to change)</li>
                            <li>- "proportion" - decimal | The proportion of the economy (Subject to change)</li>
                        </ul>
                        <li>"station_government" enum[GovernmentType] | The government type of the controlling faction</li>
                        <li>"station_faction" - string | The name of the faction that controls the stations</li>
                    </ul>

                </div>

            </div>
        </main>
    </body>
</html>
