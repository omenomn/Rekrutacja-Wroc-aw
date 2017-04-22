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

Route::get('/', 'CodesController@index')->name('home');

Route::get('codes', 'CodesController@index')->name('codes');
Route::post('codes', 'CodesController@store')->name('codes.store');
Route::delete('codes', 'CodesController@destroy')->name('codes.destroy');