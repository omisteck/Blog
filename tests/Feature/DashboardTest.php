<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_authentication()
    {
        $this->assertAuthenticationRequired('/dashboard');
        // $this->assertAuthenticationRequired('/posts/create');
    }


    public function test_index_view()
    {
        $user = User::factory()->hasPosts(5)->create();

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200)
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Dashboard')
                    ->has('data.posts.data', 5)
            );
    }


    public function test_authenticated_user_can_create_new_post()
    {
        $user = User::factory()->hasPosts(1)->create();

        $this->actingAs($user)->get('/posts/create')
            ->assertStatus(200);

        $this->actingAs($user)->post(
            '/posts',
            ['title' => 'Test Post', 'description' => 'test Description nice one', 'publication_date' => "2022-11-22"]
        )
            ->assertStatus(200)
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Posts/Create')
                    ->has('status')
            );
    }
}
