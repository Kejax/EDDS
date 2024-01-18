<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
     * @OA\Info(
     *      version="0.0.1",
     *      title="Kejax's EDDB API Documentation",
     *      description="Documentation for all publicly available API endpoints.<br>Content provided by the API may be outdated when no update was sent to the EDDN or from a trusted provider.<br>To become a trusted provider, please apply <a href='/trusted/apply'>here</a>",
     *      @OA\Contact(
     *          email="ed-api@kejax.net"
     *      ),
     * )
     */
class ApiController extends Controller
{

    public function index(Request $request) {

        return response()->json([
            'version' => '0.0.1',
            'docs' => route('l5-swagger.default.api'),
            'api-specs' => url('/docs/api-docs.json'),
            'support-email' => 'ed-api@kejax.net',
        ], 200);

    }

}
