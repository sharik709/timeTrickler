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

Route::prefix('/employer')
        ->middleware('auth')
        ->group(function(){
            Route::get('/dashboard', 'DashboardController@index');
            Route::resource('project', 'ProjectController');
            Route::resource('project.user', 'ProjectUserController');
            Route::resource('project.task', 'ProjectTaskController');
            Route::resource('team', 'TeamController');
            Route::resource('team.user', 'TeamUserController');
        });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
