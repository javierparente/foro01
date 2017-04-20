<?php

/**------------------------------------------------------------------------
|   Web Routes
|--------------------------------------------------------------------------*/

Route::get('/', function (){  return view('welcome');   });

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('posts/{post}-{slug}', ['as'=>'posts.show', 'uses'=>'PostController@show'])->where('post', '[0-9]+');



