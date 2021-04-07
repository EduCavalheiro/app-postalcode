<?php

use App\Http\Controllers\API\V1\ClientController;
use App\Http\Controllers\API\V1\PostalCodeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware(['limit-request:60,1'])->group(function () {
    Route::post('/v1/client/', [ClientController::class, 'store'])->name('client.store');
});

Route::middleware(['postalcode-identify', 'limit-request:60,1'])->group(function () {
    Route::get('/v1/search/', [PostalCodeController::class, 'index'])->name('postalcode.index');
});
