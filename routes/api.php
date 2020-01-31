<?php

use Illuminate\Http\Request;

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

Route::put('v1/catalog/{id}/rent', 'APICatalogController@putRent')->middleware('auth.basic.once');
Route::put('v1/catalog/{id}/return', 'APICatalogController@putReturn')->middleware('auth.basic.once');
Route::resource('v1/catalog', 'APICatalogController',['only' => ['index', 'show']]);
Route::resource('v1/catalog', 'APICatalogController',['except' => ['index', 'show']])->middleware('auth.basic.once');
