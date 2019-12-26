<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
 public function test_a_user_add_followers()
 {
    
     $ahmed= factory(User::class)->Create();
     $salem= factory(User::class)->Create();
     $ahmed->addFollowers($salem->id); 
     $this->assertDatabaseHas('followers', [
         'follower_id'=>$salem->id,
         'leader_id'=>$ahmed->id,
     ]);
 }

 public function test_a_user_delete_follwers()
 {
    $ahmed= factory(User::class)->Create();
    $salem= factory(User::class)->Create();
    $ahmed->addFollowers($salem->id); 
    $ahmed->deletefollowings($salem->id); 
    $this->assertDatabaseMissing('followers', [
        'follower_id'=>$salem->id,
        'leader_id'=>$ahmed->id,
    ]);
  
 }

}
