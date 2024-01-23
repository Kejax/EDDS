<?php

use App\Http\Controllers\Squadrones\SquadroneHandler;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::group([
    'alias' => 'squadrones'
], function () {

    Route::get('/squadrones/{squadrone_id}', [SquadroneHandler::class, 'index']);

    Route::post('/squadrones/create', [SquadroneHandler::class, 'create']);

    Route::any('/squadrones/{squadrone_id}/edit', [SquadroneHandler::class, 'edit']);

});
