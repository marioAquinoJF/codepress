<?php

Route::group(['prefix' => 'admin/posts',
    'as' => 'admin.posts.',
    'namespace' => 'CodePress\CodePost\Controllers',
    'middleware' => ['web']], function() {

    Route::get('/', ['uses' => 'AdminPostsController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'AdminPostsController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'AdminPostsController@store', 'as' => 'store']);
    Route::get('{id}/edit', ['uses' => 'AdminPostsController@edit', 'as' => 'edit']);
    Route::put('{id}/update', ['uses' => 'AdminPostsController@update', 'as' => 'update']);
    Route::get('{id}/show', ['uses' => 'AdminPostsController@show', 'as' => 'show']);
    Route::get('{id}/delete', ['uses' => 'AdminPostsController@delete', 'as' => 'delete']);
    Route::delete('{id}/delete', ['uses' => 'AdminPostsController@destroy', 'as' => 'delete']);

    
});
Route::group(['prefix' => 'admin/post',
    'as' => 'admin.post.',
    'namespace' => 'CodePress\CodePost\Controllers',
    'middleware' => ['web']], function() {
    // Comments

    Route::post('{id}/comment', ['uses' => 'AdminCommentsController@store', 'as' => 'store']);
    Route::put('{id}/comment/{comment}', ['uses' => 'AdminCommentsController@update', 'as' => 'update']);
    Route::delete('{id}/comment/{comment}', ['uses' => 'AdminCommentsController@destroy', 'as' => 'delete']);
});
