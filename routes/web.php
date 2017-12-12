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

Route::get('/', function () {
    return view('welcome');
});

Route::get('producao', 'ProductionController@showGeral')->middleware('auth');
Route::get('producao/{id}', 'ProductionController@show')->middleware('auth');
Route::get('producao/{id}/periodo/{ano}', 'ProductionController@showData')->middleware('auth');
Route::get('producao/{id}/periodo/{ano}/{mes}', 'ProductionController@showData')->middleware('auth');
Route::get('producao/intermediacao/{idintermediation}', 'ProductionController@getIntermediation')->middleware('auth');


Route::post('insert/productivities', 'ProductionController@insert')->middleware('auth');
Route::post('delete/productivities/{id}', 'ProductionController@delete')->middleware('auth');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('/user/{id}', 'UserController@getUser');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
