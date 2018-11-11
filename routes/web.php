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

Route::get('/', 'IndexController@ShowIndexPage');
Route::get('/spravka', 'IndexController@ShowSpravkaPage');
Route::get('/status', 'IndexController@ShowStatusPage');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
