<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('post/', 'PostController@store')->middleware('add::check_date_of_post');

Route::get('/post/{post}', 'PostController@show')->middleware('add::check_date_of_post');

//Route::get('/post/notfound', 'PostController@NotFound');
Route::view('/notfound','posts.notfound');


