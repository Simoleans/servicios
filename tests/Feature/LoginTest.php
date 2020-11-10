<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    //use DatabaseMigrations;

    /** @test */
    public function it_visit_page_of_login()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Login');
    }
   

     /**
     * @test 
     */
    public function authenticated_to_a_user()
    {
        //$user = User::factory()->create();

        $this->get('/')->assertSee('Login');
        $credentials = [
            "email" => "admin@gmail.com",
            "password" => "admin123456"
        ];

        $response = $this->post('login', $credentials);
        $response->assertRedirect('/dashboard');
        $this->assertCredentials($credentials);
    }

    /** @test */
    public function not_authenticate_to_a_user_with_credentials_invalid()
    {
        //$user = User::factory()->create();
        $credentials = [
            "email" => "users@mail.com",
            "password" => "secret"
        ];

        $this->assertInvalidCredentials($credentials);
    }

    /** @test */
    public function the_email_is_required_for_authenticate()
    {
        //$user = User::factory()->create();
        $credentials = [
            "email" => null,
            "password" => "secret"
        ];

        $response = $this->from('/')->post('login', $credentials);
        $response->assertRedirect('/')->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);
    }

    /** @test */
    public function the_password_is_required_for_authenticate()
    {
        //cls$user = $user = User::factory()->create('App\User', ['email' => 'zaratedev@gmail.com']);
        $credentials = [
            "email" => "zaratedev@gmail.com",
            "password" => null
        ];

        $response = $this->from('/')->post('login', $credentials);
        $response->assertRedirect('/')
            ->assertSessionHasErrors([
                'password' => 'The password field is required.',
            ]);
    }
    
}
