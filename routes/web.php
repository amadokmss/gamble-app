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

Route::get('/', 'GamblesController@index');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::get('users', 'UsersController@index')->name('user.index');
    Route::post('users/charge','UsersController@charge')->name('user.charge');
    Route::get('users/{id}', 'UsersController@show')->name('user.show');
    Route::get('gambles/create','GamblesController@create')->name('gamble.create');
    Route::get('gambles/{id}','GamblesController@show')->name('gamble.show');
    Route::post('store', 'GamblesController@store')->name('gamble.store');
    Route::delete('destroy', 'GamblesController@destroy')->name('gamble.destroy');
    Route::group(['prefix' => 'choose/{id}'], function () {
        Route::post('store', 'UserGambleController@store')->name('user_gamble.store');
        Route::delete('destroy', 'UserGambleController@destroy')->name('user_gamble.destroy');
    });
    Route::group(['prefix' => 'comment/{id}'], function () {
        Route::post('store', 'CommentsController@store')->name('comment.store');
        Route::delete('destroy', 'CommentsController@destroy')->name('comment.destroy');
    });
    Route::get('answer','AnswerController@create')->name('answer.create');
    Route::post('answer/create','AnswerController@store')->name('answer.store');
    Route::get('answer/index','AnswerController@index')->name('answer.index');
    Route::delete('answer/delete/{id}','AnswerController@destroy')->name('answer.destroy');
});

