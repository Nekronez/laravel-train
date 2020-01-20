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

Route::view('login', 'login')->name('login');
Route::view('', 'welcome');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/post', 'PostController@index');
Route::get('/post/create', 'PostController@create');
Route::post('/post/create', 'PostController@store');
Route::get('/post/edit/{id}', 'PostController@edit')->where('id', '[0-9]+');
Route::post('/post/edit/{id}', 'PostController@update')->where('id', '[0-9]+');
Route::delete('/post/delete/{id}', 'PostController@destroy')->where('id', '[0-9]+');
Route::get('/post/{id}', 'PostController@show')->where('id', '[0-9]+');

