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
Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->name('threads.subscript');
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->name('threads.subscript.destroy');

Route::patch('/replies/{reply}', 'RepliesController@update')->name('replies.update');
Route::delete('/replies/{reply}','RepliesController@destroy')->name('replies.destroy');
Route::post('/replies/{reply}/favorites', 'FavoritesController@store')->name('replies.favorites');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy')->name('replies.favorites.destroy');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profiles.show');
Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index')->name('notifications.index');
Route::delete('profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy')->name('notifications.destroy');

Route::get('api/users', 'Api\UsersController@index')->name('api.users.index');
Route::post('api/users/{user}/avatar', 'Api\UsersAvatarController@store')->middleware('auth')->name('api.users.avatar');


Auth::routes();

