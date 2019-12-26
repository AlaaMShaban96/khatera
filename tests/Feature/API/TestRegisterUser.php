<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestRegisterUser extends TestCase
{
    use WithFaker, RefreshDatabase;

   public function test_register_user()
   {
   
        $this->withoutExceptionHandling();
        $ahmed=  factory('App\User')->raw();
   
        $this->post('api/users/register',$ahmed)->assertOk();
        $this->assertDatabaseHas('Users',$ahmed);
   }

   public function test_register_user_required_name()
   {
    
        $ahmed= factory('App\User')->raw(["name"=>'']);
        $this->post('api/users/register', $ahmed)->assertStatus(422);

   }

   public function test_register_user_required_email_empty()
   {
    
        $ahmed= factory('App\User')->raw(["email"=>'']);
        $this->post('api/users/register', $ahmed)->assertStatus(422);

   }
   public function test_register_user_required_email_not_correct ()
   {
    
        $ahmed= factory('App\User')->raw(["email"=>'uywebiubeiegyu']);
        $this->post('api/users/register', $ahmed)->assertStatus(422);

   }


}
