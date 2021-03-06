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
    if (auth()->check()) {
        return redirect('home');
    }

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'QuestionAnswerController@index');
Route::get('/question-answer/{id}/edit-index', 'QuestionAnswerController@editIndex');
Route::post('/question-answer/{id}/update-index', 'QuestionAnswerController@updateIndex');
Route::resource('/question-answer', 'QuestionAnswerController');
