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

//admin路由
Route::any('/admin/add',"AdminController@add")->name('admin.add');
Route::get('/admin/index',"AdminController@index")->name('admin.index');
Route::any('/admin/edit/{id}',"AdminController@edit")->name('admin.edit');
Route::get('/admin/del/{id}',"AdminController@del")->name('admin.del');
Route::any('/admin/login',"AdminController@login")->name('admin.login');
Route::any('/admin/logout',"AdminController@logout")->name('admin.logout');

//user路由
Route::any('/user/add',"UserController@add")->name('user.add');
Route::get('/user/index',"UserController@index")->name('user.index');
Route::any('/user/edit/{id}',"UserController@edit")->name('user.edit');
Route::get('/user/del/{id}',"UserController@del")->name('user.del');

//记录表路由
Route::any('/record/recharge/{id}/{status}',"RecordController@recharge")->name('record.recharge');
Route::any('/record/consumption/{id}/{status}',"RecordController@consumption")->name('record.consumption');
Route::any('/record/history/{id}',"RecordController@history")->name('record.history');

//消费路由
Route::any('/meal/add',"MealController@add")->name('meal.add');
Route::get('/meal/index',"MealController@index")->name('meal.index');
Route::any('/meal/edit/{id}',"MealController@edit")->name('meal.edit');
Route::get('/meal/del/{id}',"MealController@del")->name('meal.del');

