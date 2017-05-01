<?php

use \App\Entities\Comment;

class AcceptAnswertTest extends FeatureTestCase
{

    function test_the_posts_author_can_accept_a_comment_as_the_posts_answer()
    {
        // Create a comment with a factory. it will give me an Author
        $comment = factory(Comment::class)->create([
            'comment' => 'Esta va a ser la respuesta del Post'
        ]);

        // I´m going act like a user and I am the author from the Post.
        $this->actingAs($comment->post->user);

        // Visit the page of the post
        // I must see the button 'Aceptar Respuesta'
        $this-> visit($comment->post->url)
            ->press('Aceptar respuesta');

        // Finally, We will check, the date in database by which check
        // 1.- the field 'id' is the same that the id of the post,
        // 2.- if pending is false and
        // 3.- if the id of the answer is the same that id from the comment
        $this->seeInDatabase('posts', [
            'id' => $comment->post_id,
            'pending' => false,
            //'answer_id' => $comment->id,
        ]);

        // it will redirect me again to the previous page.
        // Must have a element with the class .answer that contains a comment
        $this->seePageIs($comment->post->url)
            ->seeInElement('.answer', $comment->comment);

    }

}


