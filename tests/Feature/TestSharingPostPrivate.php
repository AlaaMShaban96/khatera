<?php

namespace Tests\Feature;


use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestSharingPostPrivate extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_sharing_post_private_is_successful ()
    {
        $post=factory('App\Post')->raw();
        
        $this->call('POST','api/post/',  $post)->assertOk();
    }
 
    public function test_sharing_post_private_required_image ()
    {
       $post=factory('App\Post')->raw(["image"=>'']);

        $this->post('api/post/',$post)->assertstatus(422);

        $this->assertDatabaseMissing('Posts',$post);
       
    }

    public function test_sharing_post_private_required_titel ()
    {
        $post=factory('App\Post')->raw(["titel"=>'']);

        $this->post('api/post/', $post)->assertstatus(422);

        $this->assertDatabaseMissing('Posts', $post);
       
    }

    public function test_sharing_post_private_required_content ()
    {
        $post=factory('App\Post')->raw(["content"=>'']);

        $this->post('api/post/', $post)->assertstatus(422);

        $this->assertDatabaseMissing('Posts', $post);
       
    }

    public function test_sharing_post_private_required_period ()
    {
        $post=factory('App\Post')->raw(["period"=>'']);

        $this->post('api/post/',$post)->assertstatus(422);

        $this->assertDatabaseMissing('Posts',$post);
       
    }


    
 
 

}
