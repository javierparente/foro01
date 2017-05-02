<?php

use App\Entities\Post;
use Carbon\Carbon;

class PostsListTest extends FeatureTestCase
{

    public function test_a_user_can_see_the_posts_list_and_go_to_the_details()
    {
        // Creamos un post
        $post = $this->createPost([
            'title' => 'Titulo Post 0'
        ]);

        //dd($post->url);

        // Access to the route.
        $this->visit('/');
        // El h1 must contain the word Posts that is the title h1
        $this->seeInElement('h1', 'Posts');
        // We must see in the page the title of the post
        $this->see($post->title);
        // We must do click on the title.
        $this->click($post->title);
        // this take to the url of the post
        $this->seePageIs($post->url);
    }

    public function test_the_posts_are_paginated()
    {
        // Having
        $first = factory(Post::class)->create(['title' => 'Post más Antiguo', 'created_at'=> Carbon::now()->subDays(2)]);

        factory(Post::class)->times(15)->create( [ 'created_at'=>Carbon::now()->subDay(1) ]);

        $last = factory(Post::class)->create(['title' => 'Post más Reciente', 'created_at' => Carbon::now()]);

        // If the user visit the page Posts '/'
        // could see the first post $first but must not
        // you can see the last post '$last'
        $this->visit('/')
            ->see($last->title)
            ->dontSee($first->title)
            ->click('2')
            ->dontSee($last->title);
    }

}

