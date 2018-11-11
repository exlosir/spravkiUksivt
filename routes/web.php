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
Route::post('/spravka/send', 'JournalZayavController@SendZayav');
Route::get('/status', 'IndexController@ShowStatusPage');


Auth::routes();

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/login');
});

Route::get('/home', 'HomeController@index')->name('home');
