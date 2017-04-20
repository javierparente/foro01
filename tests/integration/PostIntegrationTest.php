<?php

use App\Entities\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_slug_is_generated_and_saved_to_the_database()
    {
        // Creo un usuario por defecto
        $user = $this->defaultUser();

        // Creo un nuevo Post
        $post = new Post([
            'title' => 'Como instalar Laravel',
            'content' => 'Este es el contenido de Post 1'
            //, 'user_id' => $user->id,
        ]);

        // Salvo el nuevo Post si el user_id está introducido
        //$post->save();

        // Debo salvar el nuevo post en el nuevo Usuario para introducir el user_id
        $user->posts()->save($post);

        // Compruebo en la Base de Datos que el campo slug de la  tabla posts de la BD coincide con el title convertido en slug
        $this->seeInDatabase('posts', [
            'slug' => 'como-instalar-laravel'
        ]);

        // También lo puedo comprobar viendo que las 2 variables son iguales
        //$this->assertSame('como-instalar-laravel', $post->slug);

        // También lo puedo comprobar viendo que las 2 variables son iguales trayendonos una instancia fresca del Modelo Post.
        // $post->fresh()->slug es como utilizar $post = Post::first();
        $this->assertSame('como-instalar-laravel', $post->fresh()->slug);
    }
}
