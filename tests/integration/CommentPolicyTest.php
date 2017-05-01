<?php

use App\Entities\Comment;
use App\Policies\CommentPolicy;
use App\Entities\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentPolicyTest extends TestCase
{
    use DatabaseTransactions;

    public function test_the_post_author_can_select_a_comment_as_an_answer()
    {
        // Create a comment since a factory.
        $comment = factory( Comment::class )->create();

        // Instance a CommentPolicy.
        $policy = new CommentPolicy;

        // return True run function accept.
        $this->assertTrue(
            $policy->accept($comment->post->user, $comment)
        );

    }

    public function test_non_authors_cannot_select_as_an_answer()
    {
        // Create a comment since a factory.
        $comment = factory(Comment::class )->create();

        // Create a user since factory.
        $user = factory(User::class)->create();

        // Instance a CommentPolicy
        $policy = new CommentPolicy;

        // return False run function accept.
        $this->assertFalse(
            $policy->accept($user, $comment)
        );

    }

}
