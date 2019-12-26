<?php

namespace Tests\Feature\API;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestLoginUser extends TestCase
{
    use RefreshDatabase,WithFaker;
    
    public function test_user_login_successful()
    {
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
}
