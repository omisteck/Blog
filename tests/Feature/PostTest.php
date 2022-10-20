<?php

namespace Tests\Feature;

use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_guest_suser_can_get_posts()
    {
        //create users with post
        $posts = User::factory(3)->hasPosts(2)->create();

        $response = $this->get('/');

        $response->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->has('data.posts.data', 6)
        );
    }


    public function test_user_can_sort_posts()
    {

        $response = $this->get('/?sort_by=publication_date');
        
        $response->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->has('data.posts.data', 6)
        );
    }

}
