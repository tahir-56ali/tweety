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

use App\User;

//DB::listen(function ($query) { var_dump($query->sql); });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/tweets', 'TweetController@index')->name('home');
    Route::post('/tweets', 'TweetController@store');
    Route::post('/profiles/{user}/follow', 'FollowsController@store');
    Route::get('/profiles/{user}/edit', 'ProfilesController@edit')->middleware('can:edit,user');
    Route::patch('/profiles/{user}', 'ProfilesController@update');
});


Auth::routes();
