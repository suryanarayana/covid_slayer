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

Auth::routes();
//->name('home')
Route::get('/home', 'HomeController@index');

Route::get('/game_time', 'HomeController@configureGameTime');

Route::post('/save_game_time', 'HomeController@saveGameTime');

Route::get('/startgame', 'GamesController@createGame');

Route::post('/savegame', 'GamesController@saveGame');
