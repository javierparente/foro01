<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    //use DatabaseMigrations;
    use DatabaseTransactions;

    public function testBasicExample()
    {
        $name = 'Javier Parente';
        $email = 'javierparente@gmail.com';

        $user = factory(\App\User::class)->create([
            'name' => $name,
            'email' => $email,
        ]);

        $this->actingAs($user, 'api');

        $this->visit('api/user')
            ->see($name)
            ->see($email);
    }
}
