<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'LeaderboardController@index');
Route::get('/{username}', 'LeaderboardController@recordFromArray')->name('recordFromArray');
Route::post('/record/{username}', 'LeaderboardController@record')->name('record');