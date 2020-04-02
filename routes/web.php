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
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::post('projects/dynamic', 'ProjectsController@fetch')->name('projectscontroller.fetch');
    Route::post('emails/dynamic', 'EmailsController@fetch')->name('emailscontroller.fetch');
    Route::get('dynamic', 'UsersController@fetch')->name('userscontroller.fetch');

    Route::prefix('users')->group(function () {
        Route::get('import/create', 'UsersController@importCreate')->name('users.import.create');
        Route::post('dynamic', 'UsersController@fetch')->name('userscontroller.fetch');
        Route::post('import', 'UsersController@importStore')->name('users.import.store');
        Route::get('inactive', 'UsersController@inactiveIndex')->name('users.inactive.index');
        Route::delete('{user}/forced', 'UsersController@forceDelete')->name('users.forced');
        Route::put('restore/{user}', 'UsersController@restore')->name('users.restore');
    });

    Route::prefix('projects')->group(function () {
        Route::post('assign/{topic}', 'ProjectsController@assign')->name('projects.assign');
    });

    Route::resource('users', 'UsersController');
    Route::resource('subjects', 'SubjectsController', ['except' =>'show']);
    Route::resource('fields', 'FieldsController', ['except' => 'show']);
    Route::resource('levels', 'LevelsController', ['except' => 'show']);
    Route::resource('projects', 'ProjectsController');
    Route::resource('posts', 'PostsController');
    Route::resource('emails', 'EmailsController');

});

Route::namespace('Supervisor')->prefix('supervisor')->name('supervisor.')->middleware(['can:manage-projects'])->group(function (){

    Route::get('/dashboard', function () {
        return view('supervisor.dashboard');
    });
    Route::resource('projects', 'ProjectsController'); //['except' =>'index']
    Route::resource('projects/{project}/tasks', 'TasksController');
    Route::resource('emails', 'EmailsController');
});

Route::namespace('Student')->prefix('student')->name('student.')->middleware('auth')->group(function () {
    Route::resource('/topics', 'TopicsController');
    Route::resource('/ethics/form', 'EthicFormsController');
    Route::post('/ethics/form/approve{form}', 'EthicFormsController@approve')->name('ethic.form.approve');
    Route::post('/ethics/form/check{form}', 'EthicFormsController@check')->name('ethic.form.check');
    Route::get('/form/export', 'EthicFormsController@export')->name('form.export');
});

Route::middleware('can:admin-supervise')->group(function () {
    Route::resource('/suggestions', 'ProjectSuggestionController', ['except' =>'show']);
    Route::post('/suggestions/dynamic', 'ProjectSuggestionController@fetch')->name('suggestions.fetch');
});

Route::get('/projects/{project}', 'ProjectsController@show');
Route::get('/diaries/export', 'DiariesController@export')->name('diaries.export');
Route::resource('/diaries', 'DiariesController');
Route::get('/profiles/{profile}', 'ProfilesController@show')->name('profile.');
Route::put('/profiles/{profile}/update', 'ProfilesController@update')->name('profile.update');
Route::put('/profiles/{profile}/updateSubjects', 'ProfilesController@addSubject')->name('profile.updateSubject');
Route::get('/profiles/{profile}/detachSubject', 'ProfilesController@detachSubject')->name('profile.detachSubject');
Route::get('/posts/{post}', 'PostsController@show');
Route::resource('/emails', 'EmailsController');
Route::resource('/projects/{project}/meetings', 'MeetingsController');
Route::put('/projects/meetings/{meeting}', 'MeetingsController@attendance')->name('project.meeting.attendance');
Route::patch('/projects/meetings/{meeting}', 'MeetingsController@confirmation')->name('project.meeting.confirmation');
Route::put('/projects/meetings/cancel/{meeting}', 'MeetingsController@cancel')->name('project.meeting.cancel');
Route::get('/suggestions/{suggestion}', 'ProjectSuggestionController@show');
Route::get('/suggestions/fields/{field}', 'SuggestionsController@byFields')->name('fields.suggestions.list');
Route::get('/suggestions/subjects/{subject}', 'SuggestionsController@bySubject')->name('subject.suggestions.list');
//Route::get('suggestions/subjects/{subject}', 'SuggestionsController@subject')->name('subject.suggestions');
Route::get('/projects/{project}', 'ProjectsController@show')->name('studentProjects');
Route::put('/projects/{project}/tasks/{task}', 'TasksController@complete')->name('projects.tasks.complete');
Route::post('projects/dynamic', 'ProjectsController@fetch')->name('projectscontroller.fetch');


