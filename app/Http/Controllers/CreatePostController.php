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
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        //$post = Post::create($request->all());
        $post = new Post($request->all());

        //auth()->user()->posts()->save($post);
        Auth::user()->posts()->save($post);

        //return redirect('posts/'.$post->id.'-'.$post->slug);
        return redirect()->route('posts.show',[$post->id,$post->slug]);
    }

}

