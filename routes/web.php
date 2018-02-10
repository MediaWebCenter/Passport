<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['middleware' => 'auth'], function () use ($router) {


    //con eloquent
    $router->get('user','UserController@normal');
    $router->get('user/{id}','UserController@getById');
    //seleccionando campos que queremos meter no todos
    $router->get('users','UserController@staticQuery');
    $router->get('users/{id}','UserController@getById');
    $router->post('insertar','UserController@insertUser');
    $router->put('update/{id}','UserController@updatetUser');
    $router->delete('delete/{id}','UserController@deleteUser');
});





//Dingo routing da muchos problemas 
/*$api= app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->get('test', function () {
        return 'Ostia puta';
    });
});
$api->version('v1', function ($api){
    $api->get('/apiroute', function(){
        return "it works :)";
    });
    //configurar el aouth para usar con dingo
    $api->group(['prefix'=>'oauth'], function($api){

      $api->post('token','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');
    });

    $api->group(['namespace'=>'App\Http\Controllers','middleware'=>['auth:api','cors']], function ($api){

        $api->get('users','App\Api\Controllers\UserController@show');
        $api->get('try','App\Api\V1\Controllers\ExampleControllerr@prueba');
    });

    

});*/


