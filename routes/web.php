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

Route::group(['middleware'=> 'auth', 'prefix'=>'home'], function(){
    Route::get('spravki', function(){ return "Справки";})->name('zayavleniya');
    Route::get('students', function(){ return "Студенты";})->name('students');
    Route::get('groups', function(){ return "Группы";})->name('groups');
    Route::get('orders', function(){ return "Приказы";})->name('orders');
    Route::get('departments', function(){ return "Отделения";})->name('departments');
    Route::get('specialties', function(){ return "Специальности";})->name('specialties');
    Route::get('type_spravki', function(){ return "Типы справок";})->name('type_spravki');
    Route::get('users', function(){ return "Пользователи";})->name('users');
});
