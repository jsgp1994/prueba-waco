<?php

namespace Tests\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_and_retrieve_user()
    {

        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password123'),
            'birthdate' => '1990-01-01',
            'city' => 'New York',
        ]);

        $retrievedUser = User::find($user->id);

        $this->assertEquals('John Doe', $retrievedUser->name);
        $this->assertEquals('john@example.com', $retrievedUser->email);
        $this->assertTrue(\Hash::check('password123', $retrievedUser->password));
        $this->assertEquals('1990-01-01', $retrievedUser->birthdate);
        $this->assertEquals('New York', $retrievedUser->city);
    }
}
