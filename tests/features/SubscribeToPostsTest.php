<?php

use App\Entities\User;

class SubscribeToPostsTest extends FeatureTestCase
{
    // Check a user can subscribe to a Post
    function test_a_user_can_subscribe_to_a_post()
    {
        // Having
        // the first is create a Post.
        $post = $this->createPost();

        // After We create a User that was not the author of the post
        $user = factory(User::class)->create();

        // We need that the user is connected.
        $this->actingAs($user);

        // When
        // We visit the page of the post with the url
        $this->visit($post->url)
            ->press('Suscribirse al post');

        // Then
        // We check in the Pivot table whose name is subscriptions instead of 'post_user'
        // exists a relation with a user_id and post_id
        $this->seeInDatabase('subscriptions', [
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        // See that the user is redirected to the url of the post
        // and the user does not see the button already 'Suscribirse al post'
        $this->seePageIs($post->url)
            ->dontSee('Suscribirse al post');
    }

}