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

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function (){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::post('projects/dynamic', 'ProjectsController@fetch')->name('projectscontroller.fetch');

    Route::resource('users', 'UsersController');
    Route::resource('projects', 'ProjectsController');
    Route::resource('mentors', 'ProjectsController');
});

Route::namespace('Supervisor')->prefix('supervisor')->name('supervisor.')->middleware('can:manage-projects')->group(function (){

    Route::get('/dashboard', function () {
        return view('supervisor.dashboard');
    });

    Route::resource('projects', 'ProjectsController', ['except' =>'index']);
});


Route::get('/projects', 'ProjectsController@index');
Route::get('/projects/create', 'ProjectsController@create');
Route::post('projects/dynamic', 'ProjectsController@fetch')->name('projectscontroller.fetch');

