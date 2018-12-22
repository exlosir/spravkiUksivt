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
Route::post('/status/full', 'JournalZayavController@GetStatus');


Auth::routes();

Route::get('/logout',function(){
    Auth::logout();
    return redirect('/login');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=> 'auth', 'prefix'=>'home'], function(){
    Route::group(['prefix'=>'statement'], function(){ // Заявки
        Route::get('/','JournalZayavController@Index')->name('statements');
        Route::get('/{sorted}','JournalZayavController@IndexSorted');
        Route::post('/change/status','JournalZayavController@Chstatus')->name('chstatus');
        Route::get('/zayav/create/{id}','JournalZayavController@Create_spravka')->name('create_spravka');
        Route::get('/journal/get','JournalZayavController@Get_journal')->name('get_journal');
        Route::get('/new','JournalZayavController@NewStatement')->name('new_statement');
        Route::post('/new/add','JournalZayavController@AddNewStatement')->middleware('admin')->name('add_new_statement');
        Route::delete('/delete/{id}', 'JournalZayavController@Delete')->middleware('admin')->name('delete_statement');
    });
    Route::group(['prefix'=>'students'], function(){
        Route::get('/','StudentController@Index')->name('students');
        Route::get('/new','StudentController@NewStudent')->middleware('admin')->name('new_student');
        Route::post('/new/add','StudentController@AddNewStudent')->middleware('admin')->name('add_new_student');
        Route::get('/edit/{id}','StudentController@EditStudent')->middleware('admin')->name('edit_student');
        Route::patch('/edit/{id}/apply','StudentController@ApplyEditStudent')->middleware('admin')->name('apply_edit_student');
        Route::delete('/delete/{id}', 'StudentController@Delete')->middleware('admin')->name('delete_student');
    });
    Route::group(['prefix'=>'orders'], function(){
        Route::get('/','OrderController@Index')->name('orders');
        Route::get('/new','OrderController@NewOrder')->middleware('admin')->name('new_order');
        Route::post('/new/add','OrderController@AddNewOrder')->middleware('admin')->name('add_new_order');
        Route::get('/edit/{id}','OrderController@EditOrder')->middleware('admin')->name('edit_order');
        Route::patch('/edit/{id}/apply','OrderController@ApplyEditOrder')->middleware('admin')->name('apply_edit_order');
        Route::delete('/delete/{id}', 'OrderController@Delete')->middleware('admin')->name('delete_order');
        
        Route::get('/new/student_order','OrderController@NewStudentOrder')->middleware('admin')->name('new_student_order');
        Route::post('/new/student_order/add','OrderController@AddNewStudentOrder')->middleware('admin')->name('add_new_student_order');
    });
    Route::group(['prefix'=>'groups'], function(){
        Route::get('/','GroupController@Index')->name('groups');
        Route::get('/new','GroupController@NewGroup')->middleware('admin')->name('new_group');
        Route::post('/new/add','GroupController@AddNewGroup')->middleware('admin')->name('add_new_group');
        Route::get('/edit/{id}','GroupController@EditGroup')->middleware('admin')->name('edit_group');
        Route::patch('/edit/{id}/apply','GroupController@ApplyEditGroup')->middleware('admin')->name('apply_edit_group');
        Route::delete('/delete/{id}', 'GroupController@Delete')->middleware('admin')->name('delete_group');
    });
    Route::group(['prefix'=>'departments'], function(){
        Route::get('/','DepartmentController@Index')->name('departments');
        Route::get('/new','DepartmentController@NewDep')->middleware('admin')->name('new_dep');
        Route::post('/new/add','DepartmentController@AddNewDep')->middleware('admin')->name('add_new_dep');
        Route::get('/edit/{id}','DepartmentController@EditDep')->middleware('admin')->name('edit_dep');
        Route::patch('/edit/{id}/apply','DepartmentController@ApplyEditDep')->middleware('admin')->name('apply_edit_dep');
        Route::delete('/delete/{id}', 'DepartmentController@Delete')->middleware('admin')->name('delete_dep');
    });
    Route::group(['prefix'=>'specialties'], function(){
        Route::get('/','SpecialtyController@Index')->name('specialties');
        Route::get('/new','SpecialtyController@NewSpec')->middleware('admin')->name('new_spec');
        Route::post('/new/add','SpecialtyController@AddNewSpec')->middleware('admin')->name('add_new_spec');
        Route::get('/edit/{id}','SpecialtyController@EditSpec')->middleware('admin')->name('edit_spec');
        Route::patch('/edit/{id}/apply','SpecialtyController@ApplyEditSpec')->middleware('admin')->name('apply_edit_spec');
        Route::delete('/delete/{id}', 'SpecialtyController@Delete')->middleware('admin')->name('delete_spec');
    });
    // Route::group(['prefix'=>'type_spravka'], function(){
    //     Route::get('/','TypesSpravkaController@Index')->name('type_spravki');
    //     Route::get('/new','TypesSpravkaController@NewType')->middleware('admin')->name('new_type_spravki');
    //     Route::post('/new/add','TypesSpravkaController@AddNewType')->middleware('admin')->name('add_new_type_spravki');
    //     Route::delete('/delete/{id}', 'TypesSpravkaController@Delete')->middleware('admin')->name('delete_type_spravki');
    // });
    Route::group(['prefix'=>'users'], function(){ // работа с пользователями
        Route::get('/', 'UsersController@Index')->name('users');
        Route::get('/new', 'UsersController@NewUser')->middleware('admin')->name('new_user');
        Route::post('/new/add', 'UsersController@AddNewUser')->middleware('admin')->name('add_new_user');
        Route::get('/edit/{id}', 'UsersController@EditUser')->middleware('admin')->name('edit_user');
        Route::patch('/edit/{id}/apply', 'UsersController@ApplyEditUser')->middleware('admin')->name('apply_edit_user');
        Route::delete('/delete/{id}', 'UsersController@Delete')->middleware('admin')->name('delete_user');
    });
    
    
});
