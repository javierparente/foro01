<?php

/**------------------------------------------------------------------------
|   Web Routes
|--------------------------------------------------------------------------*/

Route::get( '/', ['as' => 'post.index', 'uses' => 'PostController@index'] );

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('posts/{post}-{slug}', ['as'=>'posts.show', 'uses'=>'PostController@show'])->where('post', '[0-9]+');



