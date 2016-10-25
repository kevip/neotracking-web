<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['cors']], function(){

    Route::post('auth_login','API\AuthenticateController@authenticate');

    Route::group(['middleware' => ['jwt.auth']], function(){

        Route::group(['prefix' => 'api'], function(){

            Route::resource('user', 'API\UserController');

            Route::resource('tienda', 'API\TiendasController');

            Route::resource('stock', 'API\StockController');

            Route::resource('track','API\TracksController@index');

            Route::group(['prefix' => 'user'], function(){

                Route::get('pendientes', 'API\UserController@index');

                Route::put('{id}/alta', 'API\UserController@alta');

                Route::put('{id}/baja', 'API\UserController@baja');


            });

        });

    });


    Route::get('usuarios','API\UserController@index');
    Route::get('usuarios/pendientes','API\UserController@pendientes');
    Route::get('tiendas','API\TiendasController@index');
    Route::get('tracks','API\TracksController@index');
    Route::get('tracks/{id}','API\TracksController@find');
    Route::get('movimientos','API\MovementsController@index');
    Route::put('usuario/{id}/alta','API\UserController@alta');
    Route::put('usuario/{id}/baja','API\UserController@baja');
    Route::put('mobiliario/{id}/baja','API\UserController@baja');
    Route::group(['prefix' => 'admin'],function(){
        Route::get('');
    });

});
