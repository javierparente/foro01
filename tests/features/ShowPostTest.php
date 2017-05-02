<?php
use \App\Entities\Post;

class ShowPostTest extends FeatureTestCase
{
    /**
     * We check that an user can see the details of the post
     */
    public function test_a_user_can_see_the_post_details()
    {
        // Having
        // We create a new user with the method defaultUser();
        $user = $this->defaultUser([
            'name' => 'Javier Parente',
        ]);

        // We create a Post but don´t guard into the BD. We use make for that
        $post = factory(\App\Entities\Post::class)->create([
            'title' => 'Este es el título del post',
            'content' => 'Este es el contenido del post',
            'user_id' => $user->id,
        ]);


        //dd(User::all()->toArray());

        // Como hemos usado el método make y no create debemos guardar el objeto.
        // Asignamos al $user el objeto mediante la relación posts ( hasMany ) en User.
        $user->posts()->save($post);

        //dd(Post::all()->toArray());

        // When
        // 1.- We visit the route, 2.- We check if the element h1 has the $post->title,
        // 3.- We check that it has the content of the post, and, 4.- if it has the username
        // The route is: $this->visit( route( 'posts.show', [$post->id, $post->slug] ) )
        // Re Factoring the model Post creating a ACCESOR.
        $this->visit( $post->url )
            ->seeInElement('h1',$post->title)
            ->see($post->content)
            //->see('Javier Parente')
            ;

    }

    function test_post_url_with_wrong_slugs_still_work()
    {
        $user = $this->defaultUser();

        // Creamos un Post pero no lo guardamos en la base de datos. Usamos para ello make
        // Tb podemos usar $this->createPost([...]); para crear un Post como abajo.
        $post = factory(Post::class)->make([
            'title' => 'Este es Old title del post',
            'content' => 'Este es el contenido del post'
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        //$post->title = 'New title';   $post->save(); o lo que es lo  mismo

        $post->update(['title' => 'Este es Old title del post']);

        $this->get($url)
            ->assertResponseOk()
            ->see('Este es Old title del post');
    }

    function test_old_urls_are_redirected()
    {
        $user = $this->defaultUser();

        // Creamos un Post pero no lo guardamos en la base de datos. Usamos para ello make
        $post = $this->createPost([
            'title' => 'Este es Old title del post',
            'content' => 'Este es el contenido del post'
        ]);

        $url = $post->url;

        $post->update(['title', 'New Title']);

        $this->get($url)
            ->seePageIs($post->url);
    }

}

