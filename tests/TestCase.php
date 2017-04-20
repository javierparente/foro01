<?php

use App\Entities\User;
use App\Entities\Post;


abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * @var \App\Entities\User
     */
    protected $defaultUser;


    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Crear un usuario con los atributos personalizados.
     */
    public function defaultUser( array $attributes = [] )
    {
        //Comprobamos si ya hemos creado un usuario.
        if($this->defaultUser){
            return $this->defaultUser;
        }

        // Creamos un usuario lo asignamos a la prop defaultUser y lo devolvemos con (return).
        $this->defaultUser = factory(User::class)->create( $attributes );
        return $this->defaultUser;
    }

    /**
     * Function protected para Crear un Post con los atributos personalizados.
     */
    protected function createPost(array $atributes = [])
    {
        return factory(Post::class)->create($atributes);
    }


}
