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

// <host>/api/v1/test
// need add: Authorization Bearer token
Route::group(['prefix' => 'v1', 'namespace' => 'Api', 'middleware' => 'auth:api'], function () {

	Route::post( '/test', "TestController@index" )->name( 'api_test' );


});//Route::group
