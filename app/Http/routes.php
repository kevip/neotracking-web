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

            Route::resource('categoria', 'API\CategoriasController');

            Route::get('departamento', 'API\UbicacionController@getDepartamentos');

            Route::get('provincia', 'API\UbicacionController@getProvincias');

            Route::get('region1', 'API\UbicacionController@getRegion1');

            Route::get('region2', 'API\UbicacionController@getRegion2');

            Route::resource('subcategoria1', 'API\Subcategoria1Controller');

            Route::resource('subcategoria2', 'API\Subcategoria2Controller');

            Route::resource('stock', 'API\StockController');

            Route::get('tipo-stock', 'API\StockController@getTipo');

            Route::get('stock/search', 'API\StockController@search');

            Route::resource('tienda', 'API\TiendasController');

            Route::resource('tracking','API\TracksController');

            Route::resource('ubicacion', 'API\UbicacionController');

            Route::resource('user', 'API\UserController');

            Route::group(['prefix' => 'user'], function(){

                Route::get('pendientes', 'API\UserController@index');

                Route::put('{id}/alta', 'API\UserController@alta');

                Route::put('{id}/baja', 'API\UserController@baja');


            });

        });

    });

    /**
     * rutas publicas temporales
     */
    Route::resource('user', 'API\UserController');

    Route::resource('tienda', 'API\TiendasController');

    Route::resource('stock', 'API\StockController');

    Route::resource('tracking','API\TracksController');

    Route::group(['prefix' => 'user'], function(){

        Route::get('pendientes', 'API\UserController@index');

        Route::put('{id}/alta', 'API\UserController@alta');

        Route::put('{id}/baja', 'API\UserController@baja');


    });


});
