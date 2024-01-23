<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\StationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/documentation/old', function (Request $request) {
    return view('api.documentation');
});

// Base API Routes
Route::get('/', [ApiController::class, 'index']);

Route::get('/stations/', [StationController::class, 'index']);

Route::get('/stations/search', [StationController::class, 'search']);

Route::group([
    'middleware' => ['is.number:market_id'],
    'alias' => 'station'
], function () {
    Route::get('/station/{market_id}',[StationController::class, 'get']);

    Route::post('/station/{market_id}', [StationController::class, 'update']);

    Route::get('/station/{market_id}/commodity', [StationController::class, 'getCommodity']);

    Route::post('/station/{market_id}/commodity', [StationController::class, 'updateCommodity']);
});
