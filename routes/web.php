<?php

use Illuminate\Support\Facades\Route;

Route::get('login', [ 'as' => 'login', 'uses' => 'AuthenticateController@login']);
Route::post('/authenticate', 'AuthenticateController@authenticate');
Route::get('/logout', 'AuthenticateController@logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('')->group(function () {
        Route::get('/', 'DashboardController@index');
        
        Route::prefix('clients')->group(function () {
            Route::get('', 'ClientsController@index');
            Route::get('carregar-clientes', 'ClientsController@carregarClientes');
            Route::get('create', 'ClientsController@create');
            Route::get('edit/{id}', 'ClientsController@edit');
            Route::post('store', 'ClientsController@store');
            Route::post('update/{id}', 'ClientsController@update');
            Route::get('delete/{id}', 'ClientsController@destroy');
        });

        Route::prefix('history')->group(function () {
            Route::get('', 'HistoryController@index');
            Route::get('create', 'HistoryController@create');
            Route::get('edit/{id}', 'HistoryController@edit');
            Route::post('store', 'HistoryController@store');
            Route::post('update/{id}', 'HistoryController@update');
            Route::get('delete/{id}', 'HistoryController@destroy');
        });
     

        Route::prefix('users')->group(function () {
            Route::get('', 'UsersController@index');
            Route::get('create', 'UsersController@create');
            Route::get('edit/{id}', 'UsersController@edit');
            Route::post('store', 'UsersController@store');
            Route::post('update/{id}', 'UsersController@update');
            Route::get('delete/{id}', 'UsersController@destroy');
        });

        Route::prefix('boletos')->group(function () {
            Route::get('', 'BoletosController@boleto');
            Route::post('enviar-boletos', 'BoletosController@enviarBoletos');
        });

    });
});
