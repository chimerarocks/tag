<?php

Route::group([
	'prefix' => 'admin/tags', 
	'namespace' => 'ChimeraRocks\Tag\Controllers',
	'as' => 'admin.tags.',
	'middleware' => ['web']
	], function() {
	Route::get('/', ['uses' => 'AdminTagController@index', 'as' => 'index']);
	Route::get('/create', ['uses' => 'AdminTagController@create', 'as' => 'create']);
	Route::post('/store', ['uses' => 'AdminTagController@store', 'as' => 'store']);
});