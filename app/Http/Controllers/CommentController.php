<?php

namespace App\Http\Controllers;

use \App\Entities\Comment;
use \App\Entities\Post;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // todo: Add Validation!

        $comment = new Comment([
            'comment' => $request->get('comment'),
            'post_id' => $post->id,
        ]);

        auth()->user()->comments()->save($comment);

        return redirect($post->url);
    }

    public function accept(Comment $comment)
    {
        // We Implements the access policy, if there is error it send to error 403.
        $this->authorize('accept', $comment);

        $comment->markAsAnswer();

        return redirect($comment->post->url);
    }
}
