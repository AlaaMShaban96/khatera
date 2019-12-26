<?php

namespace Tests\Feature\API;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestSharingPostPublic extends TestCase
{ use WithFaker,RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_uploade_post_public_successful()
    {
        $this->withoutExceptionHandling();
        //create user
        $user = factory(User::class)->create();
        //login user
        $this->actingAs($user,'api');
        //create post
        $post =  factory('App\Post')->create();
        //send post route
        $this->post('api/post/upload', $post->toArray());
        //check database
        $this->assertDatabaseHas('posts', $post->toArray());   
    }

    public function test_uploade_post_public_required_image()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,'api');
        $post =  factory('App\Post')->create([
            "image"=>''
        ]);
        $this->post('api/post/upload', $post->toArray())->assertstatus(422);
      
    }
    public function test_uploade_post_public_required_titel()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,'api');
        $post =  factory('App\Post')->create([
            "titel"=>''
        ]);
        $this->post('api/post/upload', $post->toArray())->assertstatus(422);
      
    }
    public function test_uploade_post_public_required_content()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,'api');
        $post =  factory('App\Post')->create([
            "content"=>''
        ]);
        $this->post('api/post/upload', $post->toArray())->assertstatus(422);
      
    }
}
