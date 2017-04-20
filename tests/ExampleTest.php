<?php

class ExampleTest extends FeatureTestCase
{

    public function testBasicExample()
    {
        $name = 'Javier Parente';
        $email = 'javierparente@gmail.com';

        $user = factory(\App\Entities\User::class)->create([
            'name' => $name,
            'email' => $email,
        ]);

        $this->actingAs($user, 'api');

        $this->visit('api/user')
            ->see($name)
            ->see($email);
    }


}
