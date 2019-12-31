<?php
namespace Tests\Feature\API;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use WithFaker,RefreshDatabase;


    /*=======================================================================================================================*/
    /*==============================================>>>  Sharing Post Public  <<============================================*/
    /*=====================================================================================================================*/
    
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
    
    /*=======================================================================================================================*/
    /*==============================================>>> Sharing Post Private  <<============================================*/
    /*=====================================================================================================================*/

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
