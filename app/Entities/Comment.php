<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'post_id'];

    protected $casts = [ 'answer' => 'boolean' ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function markAsAnswer()
    {
        // if the post has a property answer like true update and change the value to false.
        $this->post->comments()->where('answer', true)->update(['answer'=>false]);

        $this->answer = true;

        $this->save();

        $this->post->pending = false;

        $this->post->save();
    }


}




