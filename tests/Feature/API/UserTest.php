<?php

namespace Tests\Feature\API;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use WithFaker,RefreshDatabase;
   
    public function test_login_user_and_logout()
    {
        $this->withoutExceptionHandling();
        $this->artisan('passport:install');
        User::create([
        'name' => 'test',
        'email'=>'test@gmail.com',
        'password' => bcrypt('secret1234')
        ]);

        $this->POST('api/users/login',[
        'email' => 'test@gmail.com',
        'password' => 'secret1234',
        ])->assertStatus(200);

        //Login & Logout

        $response =  $this->POST('api/users/login',[
        'email' => 'test@gmail.com',
        'password' =>'secret1234',
        ])->assertStatus(200)->assertJsonStructure(['data'=>['user'=>[ 'id','name'],'access_token',]]);
    
        $token = json_decode($response->content(), true)['data']['access_token'];

        $this->post('api/users/logout', [], ['Authorization' => 'Bearer ' . $token])->assertStatus(200);
    }

    /*=======================================================================================================================*/
    /*==============================================>>>        Register       <<============================================*/
    /*=====================================================================================================================*/

    public function test_register_user()
    {
        $this->artisan('passport:install');

        $this->withoutExceptionHandling();
        $ahmed=  factory(User::class)->raw(['id'=>1]);
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
    
    /*=======================================================================================================================*/
    /*==============================================>>>         login         <<============================================*/
    /*=====================================================================================================================*/

    public function test_user_login_successful()
    {       
        $this->artisan('passport:install');
        User::create([
            'name' => 'test',
            'email'=>'test@gmail.com',
            'password' => bcrypt('secret1234')
        ]);
        //attempt login
        $this->POST('api/users/login',[
            'email' => 'test@gmail.com',
            'password' => 'secret1234',
        ])->assertStatus(200);
    
    }
    public function test_user_login_email_empty()
    {
        User::create([
            'name' => 'test',
            'email'=>'test@gmail.com',
            'password' => bcrypt('secret1234')
        ]);
        //attempt login
        $this->POST('api/users/login',[
            'email' => '',
            'password' => 'secret1234',
        ])->assertStatus(422);
    }

    public function test_user_login_email_not_correct()
    {
        User::create([
            'name' => 'test',
            'email'=>'test@gmail.com',
            'password' => bcrypt('secret1234')
        ]);
        //attempt login
        $this->POST('api/users/login',[
            'email' => 'jgigiu',
            'password' => 'secret1234',
        ])->assertStatus(422);
    }
    public function test_user_login_password_not_correct()
    {
        User::create([
            'name' => 'test',
            'email'=>'test@gmail.com',
            'password' => bcrypt('secret1234')
        ]);
        //attempt login
        $this->POST('api/users/login',[
            'email' => 'jgigiu',
            'password' => '00000000',
        ])->assertStatus(422);
    }
    public function test_user_login_password_empty()
    {
        User::create([
            'name' => 'test',
            'email'=>'test@gmail.com',
            'password' => bcrypt('secret1234')
        ]);
        //attempt login
        $this->POST('api/users/login',[
            'email' => 'jgigiu',
            'password' => '',
        ])->assertStatus(422);
    }

    /*=======================================================================================================================*/
    /*==============================================>>> User followers system <<============================================*/
    /*=====================================================================================================================*/

    public function test_user_add_and_remove_user_on_followers()
    {
        $this->withoutExceptionHandling();

        $ahmed= factory(User::class)->Create();
       
        $alaa= factory(User::class)->Create();
    
        $this->actingAs($ahmed,'api');

        $this->call('POST',"api/user/$alaa->id/follow")

        ->assertStatus(200)

        ->assertJsonStructure(['success']);

        $this->call('POST',"api/user/$alaa->id/unfollow")

        ->assertStatus(200)

        ->assertJsonStructure(['success']);
    }
    
    public function test_user_can_see_followings()
    {
        $this->withoutExceptionHandling();

        $ahmed= factory(User::class)->Create();
       
        $alaa= factory(User::class)->Create();
    
        $this->actingAs($ahmed,'api');

        $this->call('POST',"api/user/$alaa->id/follow")

        ->assertStatus(200)

        ->assertJsonStructure(['success']);

        $this->call('GET','api/user/followings')->assertOk()->assertJsonStructure([ 'data'=>[ "followings" ]]);
        $this->assertDatabaseHas('followers',[
            'id'=>1,
            'follower_id'=>$ahmed->id,
            'leader_id'=>$alaa->id
        ]);
    }
    public function test_user_can_see_posts_followers()
    {
        $this->withoutExceptionHandling();

        $ahmed= factory(User::class)->Create();
       
        $ahmed2= factory(User::class)->Create();
        $alaa= factory(User::class)->Create();

        $this->actingAs($ahmed,'api');
      
        $post =  factory('App\Post')->create(['website_link'=>"gregtre"]);
    //    dd(  $post);
        //send post route
        $this->post('api/post/upload', $post->toArray());
        //check database
        // 
        $this->assertDatabaseHas('posts',/*[
            'id'=>$post->id,
            'user_id'=>$ahmed->id,
            'titel'=>$post->titel,
            'content'=>$post->content,
            'period'=>$post->period,
            'public'=>$post->public,
        ]*/ $post->toArray());  
        $this->actingAs($alaa,'api');

       

        $this->call('POST',"api/user/$ahmed->id/follow")

        ->assertStatus(200)

        ->assertJsonStructure(['success']);
        

  $this->assertDatabaseHas('followers',[
            'id'=>1,
            'follower_id'=>$alaa->id,
            'leader_id'=>$ahmed->id
        ]);

      $this->call('GET','api/user/followingsPost')->assertOk()->assertJsonStructure([
        "data"
        ]);


      //   dd($x);
        // $this->assertEquals($x,[
        //     "data"=>[
        //             "posts"=>[

        //                 'id'=>$post->id,
        //                 'user_id'=>$ahmed->id,
        //                 'titel'=>$post->titel,
        //                 'content'=>$post->content,
        //                 'period'=>$post->period,
        //                 'public'=>$post->public,
        //             ]
        //     ]
        // ]);
    
    }
  


}
