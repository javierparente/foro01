<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\Entities\Comment;

class MarkCommentAsAnswerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_post_can_be_answered()
    {
        //  Add a $post
        $post = $this->createPost();

        // Add a factory de Comments.
        $comment = factory(Comment::class)->create([
            'post_id' => $post->id
        ]);

        // Run the method markAsAnswer of the Model Comment
        $comment->markAsAnswer();

        // This comment let's frame it inside the post and will return the response.
        $this->assertTrue($comment->fresh()->answer);

        // We verify that the'pending' property is false
        $this->assertFalse($post->fresh()->pending);
    }

    function test_a_post_can_only_have_one_answer()
    {
        // Create a Post
        $post = $this->createPost();

        // Create  2 Comments
        $comments = factory(Comment::class)->times(2)->create([
            'post_id' => $post->id
        ]);

        $comments->first()->markAsAnswer();

        $comments->last()->markAsAnswer();

        $this->assertFalse($comments->first()->fresh()->answer);

        $this->assertTrue($comments->last()->fresh()->answer);

    }

}
