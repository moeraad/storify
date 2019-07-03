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

Route::get('/', "HomeController@index");

Route::group( ['middleware' => 'auth' ], function(){
    Route::get('/profile',   "profileController@index");
    Route::get('/storyboard',   "StoryboardController@index");
    Route::get('/feeds',   "FeedsController@index");

    Route::resources([
        'topic' => 'TopicController',
        'location' => 'LocationController',
        'school' => 'SchoolController',
        'experience' => 'ExperienceController',
        'interest' => 'InterestController',
        'post' => 'PostController',
        'comment' => 'CommentController',
        'message' => 'MessageController'
    ]);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
