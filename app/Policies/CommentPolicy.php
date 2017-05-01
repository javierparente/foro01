<?php

namespace App\Policies;

use App\Entities\Comment;
use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function accept(User $user, Comment $comment)
    {
        //return $user->id === $comment->post->user_id;

        // It´s the same.
        // If the user is the own of the post
        return $user->owns($comment->post);
    }

}

