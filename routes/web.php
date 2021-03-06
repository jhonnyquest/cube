<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'CubeController@index');

Route::get('/cube', 'CubeController@getCurrent');

Route::post('/cube', 'CubeController@create');

Route::post('/cube/test_cases', 'CubeController@setTestCases');

Route::delete('/cube', 'CubeController@delete');

Route::post('/cube/update', 'CubeController@update');

Route::post('/cube/query', 'CubeController@query');
