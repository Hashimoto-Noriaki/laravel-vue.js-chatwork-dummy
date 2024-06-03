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

//新規登録
Route::get('signup','Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup','Auth\RegisterController@register')->name('signup.post');

//トップページの投稿表示
Route::get('/', 'PostController@index');

//ログイン機能
Route::get('login','Auth\LoginController@showLoginForm')->name('login');
Route::post('login','Auth\LoginController@login')->name('login.post');

//ログアウト機能
Route::get('logout','Auth\LoginController@logout')->name('logout');

//ユーザー詳細、編集、更新、削除
Route::prefix('users')->group(function (){
    Route::get('{id}','UsersController@show')->name('users.show');
    Route::get('{id}/edit','UsersController@edit')->name('users.edit');
    Route::put('{id}','UsersController@update')->name('users.update');
    Route::delete('{id}','UsersController@destroy')->name('users.delete');
});

// ログイン後
Route::group(['middleware' => 'auth'], function(){
    //投稿
    Route::prefix('post')->group(function (){
        Route::post('','PostController@store')->name('post.store');
        Route::get('{id}/edit', 'PostController@edit')->name('post.edit');
        Route::put('{id}', 'PostController@update')->name('post.update');
        Route::delete('{id}','PostController@destroy')->name('post.delete');
    });
});
