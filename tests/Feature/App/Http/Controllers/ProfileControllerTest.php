<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Database\Factories\UserFactory;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_profile(): void
    {
        $this->actingAs($this->getUser())
            ->get(action([ProfileController::class, 'edit']))
            ->assertOk()
            ->assertViewIs('profile.edit');
    }

    public function test_guest_cannot_view_profile_form(): void
    {
        $this->get(action([ProfileController::class, 'edit']))
            ->assertRedirect(route('login'));
    }

    public function test_user_can_update_profile(): void
    {
        $user = $this->getUser();

        $request = ProfileRequest::factory()->create([
            'name' => 'Test 2',
            'email' => 'test2@cutcode.ru',
            'password' => '12312312',
            'password_confirmation' => '12312312',
        ]);

        $this->actingAs($user)
            ->put(
                action([ProfileController::class, 'update']),
                $request
            )
            ->assertRedirect(route('profile.edit'));
    }


    private function getUser(): User
    {
        return UserFactory::new()->create([
            'name' => 'Test',
            'email' => 'test@cutcode.ru',
            'password' => bcrypt('123123123')
        ]);
    }
}
