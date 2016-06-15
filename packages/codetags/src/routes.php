<?php

Route::group(['prefix' => 'admin/tags',
    'as' => 'admin.tags.',
    'namespace' => 'CodePress\CodeTag\Controllers',
    'middleware' => ['web']], function() {

    Route::get('/', ['uses' => 'AdminTagsController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'AdminTagsController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'AdminTagsController@store', 'as' => 'store']);
    Route::get('{id}/edit', ['uses' => 'AdminTagsController@edit', 'as' => 'edit']);
    Route::put('{id}/update', ['uses' => 'AdminTagsController@update', 'as' => 'update']);
    Route::get('{id}/show', ['uses' => 'AdminTagsController@show', 'as' => 'show']);
    Route::get('{id}/delete', ['uses' => 'AdminTagsController@delete', 'as' => 'delete']);
    Route::delete('{id}/delete', ['uses' => 'AdminTagsController@destroy', 'as' => 'delete']);
});
