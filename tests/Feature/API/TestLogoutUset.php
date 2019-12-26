<?php

namespace Tests\Feature\API;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestLogoutUset extends TestCase
{
    use WithFaker,RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_logout_user()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        //login user
        // dd(auth()->user()->id);
          $this->actingAs($user,'api');
      
        $this->get('api/users/logout')->assertOk();
      
        
       $this->assertEquals(auth()->user()->id,$user->id);
    }
}
