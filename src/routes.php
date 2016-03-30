<?php

Route::group(['prefix' => 'admin/tags',
    'as' => 'admin.tags.',
    'namespace' => 'CodePress\CodeTag\Controllers',
    'middleware' => ['web']], function() {

    Route::get('/', ['uses' => 'AdminTagController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'AdminTagController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'AdminTagController@store', 'as' => 'store']);
    Route::get('{id}/edit', ['uses' => 'AdminTagController@edit', 'as' => 'edit']);
    Route::put('{id}/update', ['uses' => 'AdminTagController@update', 'as' => 'update']);
    Route::get('{id}/show', ['uses' => 'AdminTagController@show', 'as' => 'show']);
    Route::get('{id}/delete', ['uses' => 'AdminTagController@delete', 'as' => 'delete']);
    Route::delete('{id}/delete', ['uses' => 'AdminTagController@destroy', 'as' => 'delete']);
});
