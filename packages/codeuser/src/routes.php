<?php

Route::group([
    'prefix' => 'admin/users',
    'as' => 'admin.users.',
    'namespace' => 'CodePress\CodeUser\Controllers',
    'middleware' => ['web']
        ], function() {

    Route::get('/', ['uses' => 'AdminUserController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'AdminUserController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'AdminUserController@store', 'as' => 'store']);
    Route::get('{id}/edit', ['uses' => 'AdminUserController@edit', 'as' => 'edit']);
    Route::put('{id}/update', ['uses' => 'AdminUserController@update', 'as' => 'update']);
    Route::get('{id}/show', ['uses' => 'AdminUserController@show', 'as' => 'show']);
    Route::get('{id}/delete', ['uses' => 'AdminUserController@delete', 'as' => 'delete']);
    Route::delete('{id}/delete', ['uses' => 'AdminUserController@destroy', 'as' => 'delete']);
});
