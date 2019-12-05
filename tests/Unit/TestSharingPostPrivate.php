<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestSharingPostPrivate extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_sharing_post_private()
    {
        $response = $this->post('/api/users/login',
        ['email' => 'al2pp1a@ala.com',
        'password'=>12345678910]);

        $response->assertStatus(200);
    }
 
    public function test_user()
    {
        $user= User::find(1);
        $this->assert
    }

}
