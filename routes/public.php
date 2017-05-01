<?php

/**------------------------------------------------------------------------
|   Web Routes
|--------------------------------------------------------------------------*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get( '/', ['as' => 'post.index', 'uses' => 'PostController@index'] );

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('posts/{post}-{slug}', ['as'=>'posts.show', 'uses'=>'PostController@show'])
    ->where('post', '[0-9]+');


