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

Route::get('/', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function (){
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::post('projects/dynamic', 'ProjectsController@fetch')->name('projectscontroller.fetch');

    Route::resource('users', 'UsersController');
    Route::resource('fields', 'FieldsController', ['except'=>'show']);
    Route::resource('levels', 'LevelsController', ['except'=>'show']);
    Route::resource('projects', 'ProjectsController');
    Route::resource('mentors', 'ProjectsController');
    Route::resource('posts', 'PostsController');
});

Route::namespace('Supervisor')->prefix('supervisor')->name('supervisor.')->middleware('can:manage-projects')->group(function (){

    Route::get('/dashboard', function () {
        return view('supervisor.dashboard');
    });

    Route::resource('projects', 'ProjectsController'); //['except' =>'index']
    Route::resource('projects/{project}/tasks', 'TasksController');
});

//admin and supervisor common routes

Route::middleware('can:manage-projects')->group(function () {
    Route::resource('/suggestions', 'ProjectSuggestionController', ['except' =>'index']);
});


Route::get('/suggestions', 'ProjectSuggestionController@index');
Route::get('/suggestions/{suggestion}', 'ProjectSuggestionController@index');
Route::get('/posts/{post}', 'PostsController@show');
Route::get('/projects/{project}', 'ProjectsController@show');
Route::resource('/emails', 'EmailsController');
Route::post('projects/dynamic', 'ProjectsController@fetch')->name('projectscontroller.fetch');


