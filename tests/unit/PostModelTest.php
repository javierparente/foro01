<?php

use App\Entities\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    /**
     * Una prueba que comprueba que añadiendo el titulo genera un slug
     */
    function test_adding_a_title_generates_a_slug()
    {
        $post = new Post([
            'title' => 'Como instalar Laravel'
        ]);

        //Asigno a la propiedadd $post->slug el string 'como-instalar-laravel'
        $this->assertSame('como-instalar-laravel', $post->slug );
    }

    function test_editing_the_title_changes_the_slug()
    {
        $post = new Post([
            'title' => 'Como instalar Laravel'
        ]);

        $post->title = 'Como instalar Laravel 5.1 LTS';

        //Comprobamos que las 2 variables pasadas (expected y real) son iguales.
        $this->assertSame('como-instalar-laravel-51-lts', $post->slug );
    }
}
