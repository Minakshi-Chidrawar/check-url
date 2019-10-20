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

Route::get('/{slug}',  ['as' => 'getURL', 'uses' =>'CheckURLController@redirectUrl']);

Route::get('home', ['as' => 'checkURL', 'uses' =>'CheckURLController@checkUrl']);
Route::post('home', ['as' => 'checkURL.store', 'uses' =>'CheckURLController@store']);