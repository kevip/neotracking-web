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

            Route::get('ciudad', 'API\UbicacionController@getCiudad');

            Route::get('ciudad-by-provincia', 'API\UbicacionController@getCiudadesByProvincia');

            Route::get('channel', 'API\ChannelController@index');

            Route::get('distrito', 'API\UbicacionController@getDistrito');

            Route::get('distrito-by-ciudad', 'API\UbicacionController@getDistritosByCiudad');

            Route::get('departamento', 'API\UbicacionController@getDepartamentos');

            Route::get('departamento-by-region2', 'API\UbicacionController@getDepartamentosByRegion2');

            Route::get('filtros', 'API\ReportesController@getFiltros');

            Route::post('mobiliario', 'API\MobiliarioController@store');

            Route::resource('proveedores', 'API\ProveedoresController');

            Route::get('provincia', 'API\UbicacionController@getProvincias');

            Route::get('provincia-by-departamento', 'API\UbicacionController@getProvinciasByDepartamento');

            Route::get('region1', 'API\UbicacionController@getRegion1');

            Route::get('retail', 'API\RetailController@index');

            Route::get('region2', 'API\UbicacionController@getRegion2');

            Route::get('region2-by-region1', 'API\UbicacionController@getRegion2ByRegion1');

            Route::get('rol', 'API\RolesController@index');

            /*Route::resource('subcategoria1', 'API\Subcategoria1Controller',
                ['only' => ['index', 'store', 'show']]);*/

            Route::get('subcategoria1', 'API\SubCategoria1Controller@index');

            Route::get('subcategoria1/{id}', 'API\SubCategoria1Controller@show');

            /*Route::resource('subcategoria2', 'API\Subcategoria2Controller',
                ['only' => ['index', 'store', 'show']]);*/

            Route::get('subcategoria2', 'API\SubCategoria2Controller@index');

            Route::get('subcategoria2/{id}', 'API\SubCategoria2Controller@show');

            Route::resource('stock', 'API\StockController');

           // Route::get('stock/search', 'API\StockController@search');

            Route::post('stock/search', 'API\ReportesController@search');

            Route::post('stock/codigos', 'API\ReportesController@getCodigos');

            Route::put('stock/{id}/baja', 'API\StockController@baja');

            Route::get('stock/{codigo}/historial', 'API\StockController@getHistory');

            Route::get('stock/{codigo}/last-track', 'API\StockController@getLastTrack');

            Route::post('stock-nuevo', 'API\StockController@newStock');

            Route::get('stock-registros', 'API\StockController@getRegistros');

            //Route::resource('tienda', 'API\TiendasController');

            //Route::resource('tracking','API\TracksController');

            Route::get('tipo-tienda', 'API\TiendasController@getTipo');

            Route::put('tracking/{id}/baja','API\TracksController@baja');

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

    Route::resource('api/tienda', 'API\TiendasController');

    //Route::get('api/tienda', 'API\TiendasController@index');

    Route::resource('stock', 'API\StockController');

    Route::resource('api/tracking','API\TracksController');

    Route::group(['prefix' => 'user'], function(){

        Route::get('pendientes', 'API\UserController@index');

        Route::put('{id}/alta', 'API\UserController@alta');

        Route::put('{id}/baja', 'API\UserController@baja');


    });


});
