<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThirdPartyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_console_command()
    {
        //creating th admin user to add the fetch post under
        User::factory()->create([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@blog.com',
        ]);

        $this->artisan('post:fetch')->assertExitCode(0);
    }
}
