<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CreatePostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        //$post = Post::create($request->all());

        $this->validate($request,[
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = new Post($request->all());

        Auth::user()->posts()->save($post);

        //auth()->user()->posts()->save($post);

        return $post->title;
    }


}

