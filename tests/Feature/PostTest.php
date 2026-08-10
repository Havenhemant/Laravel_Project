<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_posts()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_create_post()
    {
     
        $user = User::create([
            'username' => 'testuser',
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($user)->post('/posts', [
            'title' => 'Test Post',
            'body' => 'This is test content' 
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post'
        ]);
    }

    public function test_guest_cannot_create_post()
    {
        $response = $this->post('/posts', [
            'title' => 'Test',
            'body' => 'Test content' 
        ]);

        $response->assertRedirect('/login');
    }
}