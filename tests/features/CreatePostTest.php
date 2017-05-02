<?php


class CreatePostTest extends FeatureTestCase
{
    /**
     * Comprobar que un usuario puede crear un post
     */
    public function test_a_user_create_a_post()
    {
        // Create a new user with the method defaultUser();
        $user = $this->defaultUser();

        // Having a inf and a user connected
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        // Autenticar un usuario dado.
        $this->actingAs($user);

        // When
        // Visitar una ruta o URL dado.
        $this->visit(route('posts.create'))                 // visitamos la ruta post.create
            ->type($title, 'title')                         // Texto en el campo title
            ->type($content, 'content')                     // Texto en el campo content
            ->press('Publicar');                            // Press el botón Publicar

        // Then
        // Comprobamos si el registro fue creado correctamente en la base de datos en la tabla posts.
        $this->seeInDatabase('posts', [
            'title' => $title,                              // En el campo title 'Esta es ...'
            'content' => $content,                          // En el campo content 'Este es ...'
            'pending' => true,                              // El status del post
            'user_id'=> $user->id,                          // Es asignado al usuario correcto.
            'slug' => str_slug($title, '-'),                // Creamos el slug
        ]);

        // the user is redirect to the detail of the post
        // $this->seeInElement('h1', $title);
        // Check if the user was redirect to another page
        //$this->dontSee($title);
    }

    /**
     *  Comprobamos que si no estamos autenticados nos redirige a la ruta de login.
     */
    public function test_creating_a_post_requires_authentication()
    {
        // No hay usuario registrado.

        // When
        // Intentamos visitar esta ruta sin habernos conectado,logueado anteriormente.(Comprobamos si Existe Middleware).
        $this->visit(route('posts.create'));

        // Como no estamos conectados en este test Deberíamos ser llevados a la ruta login. Se podrían encadenar ambos métodos.
        $this->seePageIs(route('login'));

        // Podríamos crear un mensaje de alerta...
        // $this->see();
    }

    /**
     * Validación del formulario para crear un post
     */
    public function test_create_post_form_validation()
    {
        // Lo primero que hacemos crear un usuario por defecto
        $user = $this->defaultUser();

        // Nos conectamos con el usuario creado. ( Nos Autenticamos )
        $this->actingAs($user);

        // Visitamos la ruta 'posts.create'
        $this->visit(route('posts.create'));

        // Presionamos el botón "Publicar".
        $this->press('Publicar');

        // A pesar de press 'Publicar' seguimos en la misma pagina porque no hemos rellenado el Formulario.
        $this->seePageIs(route('posts.create'));

        // Comprobamos los errores en el Formulario. Miramos que en el campo indicado el texto es el siguiente.
        $this->seeInElement('#field_title .help-block',  'El campo título es obligatorio');
        // $this->seeInElement('#field_content .help-block',  'El campo contenido es obligatorio');
    }


}

