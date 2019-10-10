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

use App\Chair;
use App\Topic;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function(){
	$chairs = Chair::all();
	return view('admin', ['chairs' => $chairs]);
})->middleware('role:admin');

Route::post('/login', 'UserController@authenticate');

Route::get('/change-password/{user}/{newPassword}', 'UserController@updateById');

Route::get('/logout', 'UserController@logout');

Route::post('/student/', 'UserController@registerStudent')->middleware('role:admin');
Route::post('/professor/', 'UserController@registerProfessor')->middleware('role:admin');

Route::get('/courseworks', 'CourseworkController@getForProfessor')->middleware('role:professor');

Route::get('/create-coursework', function(){
	$topics = Topic::all();
	return view('create-coursework', ['topics' => $topics]);
})->middleware('role:professor');

Route::get('/subjects/{name}', 'CourseworkController@searchSubjects');

Route::post('/coursework', 'CourseworkController@create')->middleware('role:professor');

Route::get('/coursework/activate/{coursework}', 'CourseworkController@activate')->middleware('role:professor');
Route::get('/coursework/deactivate/{coursework}', 'CourseworkController@deactivate')->middleware('role:professor');

Route::get('/settings', function(){
	return view('settings');
});

Route::post('/avatar', 'UserController@saveAvatar');
Route::post('/username', 'UserController@changeUsername');
Route::post('/password', 'UserController@changePassword');

Route::get('/search', 'SearchController@search');

Route::get('/current-coursework', 'CourseworkController@getCurrent')->middleware('role:student');

Route::get('/apply/{coursework}', 'CourseworkController@apply')->middleware('role:student');

Route::get('/current-applications', 'CourseworkController@getCurrentApplications')->middleware('role:student');

Route::get('/previous-courseworks', 'CourseworkController@getPreviousCourseworks')->middleware('role:student');

Route::get('/applications', 'CourseworkController@getApplications')->middleware('role:professor');

Route::get('/approve/{application}', 'CourseworkController@approve')->middleware('role:professor');
Route::get('/finish/{coursework}', 'CourseworkController@finish')->middleware('role:student');
Route::get('/students-work', 'CourseworkController@getStudentsWork')->middleware('role:professor');

Route::get('/search/subjects/{query}', 'SearchController@querySubject');
Route::get('/search/subject/{subject}', 'SearchController@searchBySubject');

Route::get('/search/topics/{query}', 'SearchController@queryTopic');
Route::get('/search/topic/{topic}', 'SearchController@searchByTopic');

Route::get('/search/professors/{sq}', 'SearchController@queryProfessor');
Route::get('/professor/{professor}', 'SearchController@professorInfo');

Route::get('/search/courseworks/{query}', 'SearchController@queryCoursework');