<?php

// use App\Post;
// use App\User;
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



Route::POST('post/', 'Api\PostController@store')->middleware('addJSON');//this route for Sharing post private   


Route::POST('users/register', 'Api\AuthController@register');//this route for  register user

Route::POST('users/login', 'Api\AuthController@login');// this for login  user



Route::group(['middleware' => ['auth:api','addJSON']], function () {

        Route::GET('post/upload', 'Api\PostController@upload_store');  //this for upload post


        Route::POST('users/logout', 'Api\AuthController@logout');// this for logout from account


        Route::group(['prefix' => 'user'], function () {


                Route::GET('/followers'       , 'Api\FollowerController@followers');//get all user was following you 

                Route::GET('/followings'      , 'Api\FollowerController@followings'); //get all user are you following  

                Route::POST('/{user}/follow'  , 'Api\FollowerController@followUser');// follow user

                Route::POST('/{user}/unfollow', 'Api\FollowerController@unFollowUser');// unfollow user

                Route::GET('/followingsPost'  , 'Api\FollowerController@followingsPost');// get all post from users following
        });


        Route::GET('search/', 'Api\UserController@searchByName');// search on user by name 

        Route::GET('search/{user}/show', 'Api\UserController@show');// show post of user


});
