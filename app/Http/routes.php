<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['auth']], function () {
   Route::get('/logout', [
      'uses' => 'UserController@getLogout',
      'as' => 'logout'
   ]);

   Route::get('/dashboard', [
     'uses'=> 'PostController@getDashboard',
     'as' => 'dashboard'
   ]);

   Route::get('/account', [
      'uses' => 'UserController@getAccount',
      'as' => 'account'
   ]);

   Route::post('/updateaccount',[
      'uses' => 'UserController@postSaveAccount',
      'as' => 'account.save'
   ]);

   Route::post('/createpost', [
      'uses' => 'PostController@postCreatePost',
      'as' => 'post.create'
   ]);

   Route::get('/delete-post/{post_id}',[
      'uses' => 'PostController@getDeletePost',
      'as' => 'post.delete'
   ]);

   Route::post('/edit', [
      'uses' => 'PostController@postEditPost',
      'as' => 'edit'
   ]);

   Route::post('/like', [
      'uses' => 'PostController@postLikePost',
      'as' => 'like'
   ]);

   Route::get('/userimage/{filename}', [
      'uses' => 'UserController@getUserImage',
      'as' => 'account.image'
   ]);

   Route::get('/find-friends', [
      'uses' => 'FriendController@getUsers',
      'as' => 'friend-find'
   ]);

   Route::post('/request',[
      'uses' => 'FriendController@requestFriend',
      'as' => 'friend-request'
   ]);
});

Route::group(['middleware' => ['guest']], function () {
   Route::get('/', function () {
       return view('welcome');
   })->name('home');

   Route::post('/signup',[
     'uses'=> 'UserController@postSignUp',
     'as' => 'signup'
   ]);

   Route::post('/signin',[
     'uses'=> 'UserController@postSignIn',
     'as' => 'signin'
   ]);
});
