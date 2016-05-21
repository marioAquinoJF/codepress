<?php

Route::group(['prefix' => 'admin/posts',
    'as' => 'admin.posts.',
    'namespace' => 'CodePress\CodePost\Controllers',
    'middleware' => ['web']], function() {

    Route::get('/', ['uses' => 'AdminPostController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'AdminPostController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'AdminPostController@store', 'as' => 'store']);
    Route::get('{id}/edit', ['uses' => 'AdminPostController@edit', 'as' => 'edit']);
    Route::put('{id}/update', ['uses' => 'AdminPostController@update', 'as' => 'update']);
    Route::get('{id}/show', ['uses' => 'AdminPostController@show', 'as' => 'show']);
    Route::get('{id}/delete', ['uses' => 'AdminPostController@delete', 'as' => 'delete']);
    Route::delete('{id}/delete', ['uses' => 'AdminPostController@destroy', 'as' => 'delete']);
});