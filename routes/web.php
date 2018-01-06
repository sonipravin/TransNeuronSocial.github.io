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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'UserController@index')->name('home');
Route::get('/friends', 'UserController@friendlist')->name('friends');
Route::get('/request', 'UserController@friendRequestList')->name('request');
Route::get('/acceptRequest/{id}', 'UserController@acceptfriendRequestList');

Route::get('/other_profile/{id}','UserController@otherprofile');
