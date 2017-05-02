<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        $posts = Post::orderBy('created_at', 'DESC' )->paginate(15);

        //dd($posts->pluck('title', 'id')->toArray());

        //return view('posts.index');
        //$posts = Post::paginate(20);
        //return view('posts.index')->with('posts',$posts);
        //return view('posts.index', compact('posts'));

        return view( 'posts.index', ['posts'=>$posts] );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, $slug)
    {
        // We check the slug of BD is equal that we receive,
        // if is not the same abort with error 404.
        if($post->slug != $slug){
            return redirect ($post->url);
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
