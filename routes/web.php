<?php


use Illuminate\Support\Facades\Route;

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

// Use for Vue.JS
// Route::get('/{any?}', function () {
//     return view('welcome');
// });

Route::get('/', function(){
    return view('index');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::resource("/questions", 'QuestionController');
// Route::get('/questions/{slugs}','QuestionController@show')->name('questions.show');
Route::resource("/questions.answers",'AnswersController')->except(['index','create','show']);
// Route::post('/questions/{question}/answers','AnswersController@store')->name('answers.store');
Route::post('/answers/{answer}/accept','AcceptAnswerController')->name('answers.accept');

// Initiate Favorite
Route::post('/questions/{question}/favorites','FavoritesController@store')->name('questions.favorite');
// Initiate UnFavorite
Route::delete('/questions/{question}/favorites','FavoritesController@destroy')->name('questions.unfavorite');