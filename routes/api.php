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

Route::resource('/sample', 'Api\SampleController')->only(['show']);

Route::post('/test_items_query', 'TestItemController@getTestItemsQuery');

Route::post('/get_user_for_lab', 'LabUserController@getUserForLab');

Route::get('/test_items_show/{id}', 'TestItemController@testItemShow');

Route::post('/fill_up_observed_value', 'TestController@fillUpJobObservedValue');
