<?php

namespace Auth\DTOs;

use App\Http\Requests\Auth\SignUpFormRequest;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewUserDTOTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_instance_created_from_form_request(): void
    {
        $dto = NewUserDTO::fromRequest(
            new SignUpFormRequest([
                'name' => 'test',
                'email' => 'testing@cutcode.ru',
                'password' => '123',
            ])
        );

        $this->assertInstanceOf(NewUserDTO::class, $dto);
    }
}