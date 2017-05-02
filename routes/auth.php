<?php
/**------------------------------------------------------------------------*
|    Routes that require authentication
|--------------------------------------------------------------------------*/
use Illuminate\Support\Facades\Route;
/**------------------------------------------------------------------------*
|    Posts
|--------------------------------------------------------------------------*/

Route::get('posts/create', [
    'uses' => 'CreatePostController@create',
    'as' => 'posts.create'
]);

Route::post('posts/create', [
    'uses' => 'CreatePostController@store',
    'as' => 'posts.store'
]);

Route::post('posts/{post}/comment', [
    'uses' => 'CommentController@store',
    'as' => 'comments.store'
]);


Route::post('posts/{post}/subscribe',[
    'uses' => 'SubscriptionController@subscribe',
    'as' => 'post.subscribe'
]);

/**------------------------------------------------------------------------*
|    Comments
|--------------------------------------------------------------------------*/
Route::post('comments/{comment}/accept', [
    'uses' => 'CommentController@accept',
    'as' => 'comments.accept'
]);

