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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/aeronaves', 'AeronaveController@index')->name('aeronaves.index')->middleware('auth');
Route::get('/aeronaves/create', 'AeronaveController@create')->name('aeronaves.create')->middleware('auth');
Route::post('/aeronaves', 'AeronaveController@store')->name('aeronaves.store')->middleware('auth');
Route::get('/aeronaves/{aeronave}/edit', 'AeronaveController@edit')->name('aeronaves.edit')->middleware('auth');
Route::put('/aeronaves/{aeronave}', 'AeronaveController@update')->name('aeronaves.update')->middleware('auth');
Route::delete('/aeronaves/{aeronave}', 'AeronaveController@destroy')->name('aeronaves.destroy')->middleware('auth');
Route::get('/aeronaves/{aeronave}/pilotos', 'AeronaveController@pilotosAutorizados')->name('aeronaves.pilotosAutorizados')->middleware('auth');
Route::delete('/aeronaves/{aeronave}/pilotos/{piloto}', 'AeronaveController@naoAutorizarPiloto')->name('aeronaves.naoAutorizarPiloto')->middleware('auth');
Route::get('/aeronaves/{aeronave}/pilotosNaoAutorizados', 'AeronaveController@pilotosNaoAutorizados')->name('aeronaves.pilotosNaoAutorizados')->middleware('auth');
Route::post('/aeronaves/{aeronave}/pilotos/{piloto}', 'AeronaveController@autorizarPiloto')->name('aeronaves.autorizarPiloto')->middleware('auth');

Route::get('/socios', 'UtilizadorController@index')->name('socios.index')->middleware('auth');
Route::get('/socios/create', 'UtilizadorController@create')->name('socios.create')->middleware('auth');
Route::post('/socios', 'UtilizadorController@store')->name('socios.store')->middleware('auth');
Route::get('/socios/{socio}/edit', 'UtilizadorController@edit')->name('socios.edit')->middleware('auth');
Route::put('/socios/{socio}', 'UtilizadorController@update')->name('socios.update')->middleware('auth');
Route::delete('/socios/{socio}', 'UtilizadorController@destroy')->name('socios.destroy')->middleware('auth');

Route::get('/movimentos', 'MovimentoController@index')->name('movimentos.index')->middleware('auth');

Auth::routes(['register' => false]);
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');