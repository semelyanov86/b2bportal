<?php

use Illuminate\Http\Request;
use FleetCart\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', 'ApiController@index');
//Route::apiResource('/contracts', 'ApiContractsController');
Route::post('/add-update-good', 'ApiController@updategoods')->name('AddUpDateGood');
Route::post('/upload-product-foto', 'ApiController@uploadPhoto')->name('uploadPhoto');