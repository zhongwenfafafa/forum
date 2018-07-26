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

Route::get('/threads/create', 'ThreadsController@create')->name('threads.create');
Route::get('/threads/{channel?}', 'ThreadsController@index')->name('threads.index');
Route::post('/threads', 'ThreadsController@store')->name('threads.store');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show')->name('threads.show');
Route::delete('/threads/{channel}/{thread}', 'ThreadsController@destroy')->name('threads.destroy');
Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index')->name('replies.index');
Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store')->name('replies.store');

Route::patch('/replies/{reply}', 'RepliesController@update')->name('replies.update');
Route::delete('/replies/{reply}','RepliesController@destroy')->name('replies.destroy');
Route::post('/replies/{reply}/favorites', 'FavoritesController@store')->name('replies.favorites');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy')->name('replies.favorites.destroy');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profiles.show');

Auth::routes();

