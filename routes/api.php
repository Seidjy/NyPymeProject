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

Route::middleware('auth:api')->post('/customers','CustomerController@getCustomerFromStore');
Route::middleware('auth:api')->post('/debit','DealsController@storeDebitAPI');

Route::post('/customer','CustomerController@getCustomerAPI');
Route::post('/prize','PrizesController@getPrizesForCustomer');

Route::middleware('auth:api')->post('/deals','DealsController@storeDelasAPI');
Route::middleware('auth:api')->post('/prizes','PrizesController@getPrizes');

