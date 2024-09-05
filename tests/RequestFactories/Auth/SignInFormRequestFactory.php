<?php

namespace Tests\RequestFactories\Auth;

use Worksome\RequestFactories\RequestFactory;

class SignInFormRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'email' => $this->faker->email,
            'password' => $this->faker->password(8)
        ];
    }
}
