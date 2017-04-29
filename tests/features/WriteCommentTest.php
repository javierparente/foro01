<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WriteCommentTest extends FeatureTestCase
{
    public function test_a_user_can_write_a_comment()
    {
        //Necesitamos disponer de un post q lo creamos con el helper createPost()
        $post = $this->createPost();

        // Necesitamos disponer de un usuario.
        $user = $this->defaultUser();

        // Actuando como un usuario conectado.
        $this->actingAs($user);
        // Visitamos la url del Post
        $this->visit($post->url);
        // Escribimos un comentario en el campo comment
        $this->type('Un comentario', 'comment');
        // Presionamos en botón con el texto Publicar comentario
        $this->press('Publicar comentario');

        //dd( $user->toArray(), $post->user->toArray() );

        // Veremos en la BD en la tabla comments un nuevo comment y el autor de ese comentario (user_id)
        // va a ser el usuario conectado. Debo cerciorarme que ese comentario está asociado a un Post.
        $this->seeInDatabase('comments',[
            'comment'=>'Un comentario',
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        // Una vez que el usuario ha escrito el comentario será redirigido a la página del Post.
        $this->seePageIs($post->url);
    }


}

