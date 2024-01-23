<?php

namespace App\Http\Controllers\Squadrones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Laravel OpenApi Demo Documentation",
     *      description="L5 Swagger OpenApi description",
     *      @OA\Contact(
     *          email="admin@admin.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )

     *
     * @OA\Tag(
     *     name="Projects",
     *     description="API Endpoints of Projects"
     * )
    */
class SquadroneHandler extends Controller
{

    public function index(Request $request, int $squadrone_id) {
        response('', 501);
    }

    public function create(Request $request) {
        response('', 501);
    }

    public function edit(Request $request, int $squadrone_id) {
        response('', 501);
    }

}