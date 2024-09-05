<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class ProfileRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'password' => $this->faker->password(9)
        ];
    }
}
