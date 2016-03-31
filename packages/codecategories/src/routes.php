<?php

Route::group(['prefix' => 'admin/categories',
    'as' => 'admin.categories.',
    'namespace' => 'CodePress\CodeCategory\Controllers',
    'middleware' => ['web']], function() {

    Route::get('/', ['uses' => 'AdminCategoryController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'AdminCategoryController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'AdminCategoryController@store', 'as' => 'store']);
    Route::get('{id}/edit', ['uses' => 'AdminCategoryController@edit', 'as' => 'edit']);
    Route::put('{id}/update', ['uses' => 'AdminCategoryController@update', 'as' => 'update']);
    Route::get('{id}/show', ['uses' => 'AdminCategoryController@show', 'as' => 'show']);
    Route::get('{id}/delete', ['uses' => 'AdminCategoryController@delete', 'as' => 'delete']);
    Route::delete('{id}/delete', ['uses' => 'AdminCategoryController@destroy', 'as' => 'delete']);
});
