<?php

use App\Entities\Post;

class PostsListTest extends FeatureTestCase
{

    public function test_a_user_can_see_the_posts_list_and_go_to_the_details()
    {
        // Creamos un post
        $post = $this->createPost([
            'title' => 'Titulo Post 0'
        ]);

        dd($post->url);

        // Accedemos a la ruta.
        $this->visit('/');
        // El h1 debe contener la palabra Posts que es el título h1
        $this->seeInElement('h1', 'Posts');
        // Debemos ver en la página el título del post
        $this->see($post->title);
        // Debemos poder hacer click encima del título.
        $this->click($post->title);
        // Y nos lleva a la url del $post
        $this->seePageIs($post->url);
    }

    public function test_the_posts_are_paginated()
    {
        // Having
        $first = factory(Post::class)->create(['title' => 'El primer Post']);

        //dd($first);

        factory(Post::class)->times(15)->create();

        $last = factory(Post::class)->create(['title' => 'El último Post']);

        // Si el usuario visita la página de Posts '/' debería poder ver el primer post $first pero no debería
        // Poder ver el último post 'last'
        $this->visit('/')
            ->see($first->title)
            ->dontSee($last->title)
            ->click('2')
            ->see($last->title)
            ->dontSee($first->title);
    }
}
