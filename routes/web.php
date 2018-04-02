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

Route::get('cotacao', 'QuotationController@index')->middleware('auth');
Route::post('insert/quotation', 'QuotationController@insert')->middleware('auth');
Route::post('delete/quotation/{id}', 'QuotationController@delete')->middleware('auth');
Route::post('update/quotation', 'QuotationController@update')->middleware('auth');
Route::post('update/quotation/status', 'QuotationController@updateStatus')->middleware('auth');

Route::get('relatorio', 'ReportController@index')->middleware('auth');
Route::get('relatorio/mensal', 'ReportController@mensal')->middleware('auth');
Route::get('relatorio/{id}/periodo/{ano}', 'ReportController@showData')->middleware('auth');

Route::get('downloadReport/{type}', 'ReportController@downloadExcel');
Route::get('downloadAnual/{type}', 'ReportController@downloadAnual');
Route::get('downloadCotacao/{type}', 'QuotationController@downloadCotacao');
Route::get('listaEmails/{type}', 'HomeController@listaEmails');


Route::get('seguradoras', 'SeguradoraController@index');
Route::post('seguradora/inserir', 'SeguradoraController@inserir');
Route::post('seguradora/deletar/{id}', 'SeguradoraController@deletar');
Route::post('seguradora/atualizar/{id}', 'SeguradoraController@atualizar');

Route::get('corretoras', 'CorretoraController@index');
Route::post('corretora/inserir', 'CorretoraController@inserir');
Route::post('corretora/deletar/{id}', 'CorretoraController@deletar');
Route::post('corretora/atualizar/{id}', 'CorretoraController@atualizar');



Route::get('/user/{id}', 'UserController@getUser');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
