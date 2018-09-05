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


$api = app(Dingo\Api\Routing\Router::class);
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers', 'middleware' => 'jwt.auth'], function ($api) {
        //clients api
        $api->get('clients/all', 'ClientsController@index');
        $api->get('clients/{id}', 'ClientsController@show');

        //teams api
        $api->get('/getTeams', 'TeamsController@index');

        //update guess
        $api->post('/submit_guess', 'ClientsController@submit');

        //get configs
        $api->get('/configs/all','ConfigsController@show');
    });

    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('getToken', 'AuthController@authenticate');
    });
});