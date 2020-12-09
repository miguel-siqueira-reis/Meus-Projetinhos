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

Route::get('/laravelinfo', function () {
    return view('welcome');
});

Route::get('/series', 'SeriesControllers@index')->name('get_series')->middleware('autenticar');

Route::get('/series/adicionar', 'SeriesControllers@create')->name('get_criar_series')->middleware('autenticar');

Route::post('/series/adicionar', 'SeriesControllers@store');

Route::delete('/series/remover/{id}', 'SeriesControllers@destroy');

Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');

Route::post('/series/{serieId}/editar', 'SeriesControllers@updateName');

Route::post('/temporadas/{temporada}/assistir', 'EpisodiosController@assistir');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'LogarInAppController@index')->name('entrar');

Route::post('/entrar', 'LogarInAppController@login');

Route::get('/registrar', 'RegisterController@index');

Route::post('/registrar', 'RegisterController@store');

Route::get('/sair', function() {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect()->route('entrar');
});



