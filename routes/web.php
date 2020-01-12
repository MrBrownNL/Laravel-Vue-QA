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

Route::get('/',  'QuestionsController@index');

Auth::routes(['verify' => true]);


Route::middleware('auth')->group(function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('questions', 'QuestionsController')->except('show', 'index');
//Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store');
// or use resource
    Route::resource('questions.answers', 'AnswersController')->only(['index', 'store', 'edit', 'update', 'destroy']); // or ->except(['index', 'create', 'show'])

    Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');

    Route::post('/questions/{question}/favorites', 'FavoritesController@store')->name('questions.favorite');
    Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')->name('questions.unfavorite');

    Route::post('/questions/{question}/vote','VoteQuestionController');
    Route::post('/answers/{answer}/vote','VoteAnswerController');

});

Route::get('/questions', 'QuestionsController@index')->name('questions.index');
Route::get('/questions/{question}', 'QuestionsController@show')->name('questions.show');

