<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /** @test */
    public function can_register()
    {
        $this->postJson(route('register'), [
            'name' => 'TestUser',
            'email' => 'test@test.app',
            'password' => 'Password1',
            'password_confirmation' => 'Password1',
        ])
        ->assertSuccessful()
        ->assertJsonStructure(['status']);
    }

    /** @test */
    public function can_not_register_with_existing_email()
    {
        factory(User::class)->create(['email' => 'test@test.app']);

        $this->postJson(route('register'), [
            'name' => 'TestUser',
            'email' => 'test@test.app',
            'password' => 'Password1',
            'password_confirmation' => 'Password1',
        ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
    }
}
