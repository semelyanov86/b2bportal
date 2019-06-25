<?php

Route::get('contracts', [
    'as' => 'admin.contracts.index',
    'uses' => 'ContractsController@index',
    'middleware' => 'can:admin.contracts.index',
]);

Route::post('contracts', [
    'as' => 'admin.contracts.store',
    'uses' => 'ContractsController@store',
    'middleware' => 'can:admin.contracts.create',
]);

Route::get('contracts/create', [
    'as' => 'admin.contracts.create',
    'uses' => 'ContractsController@create',
    'middleware' => 'can:admin.contracts.create',
]);

Route::get('contracts/{id}/edit', [
    'as' => 'admin.contracts.edit',
    'uses' => 'ContractsController@edit',
    'middleware' => 'can:admin.contracts.edit',
]);

Route::put('contracts/{id}', [
    'as' => 'admin.contracts.update',
    'uses' => 'ContractsController@update',
    'middleware' => 'can:admin.contracts.edit',
]);

Route::delete('contracts/{id}', [
    'as' => 'admin.contracts.destroy',
    'uses' => 'ContractsController@destroy',
    'middleware' => 'can:admin.contracts.destroy',
]);
