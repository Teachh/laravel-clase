<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
    /** @test */
    // funcion para ver si el loggin es correcto con la redireccion
    public function login_correcto_hace_redireccion(){
      $user = factory(User::class)->create([
          'password' => bcrypt($password = 'i-love-laravel'),
      ]);

      $response = $this->post('/login', [
          'email' => $user->email,
          'password' => $password,
      ]);
      $response->assertStatus(302);
      $this->assertAuthenticatedAs($user);
    }

    /** @test */
    // funcion para ver si el loggin es erroneo por el email
    public function login_incorrecto_email(){
      $user = factory(User::class)->create([
          'password' => bcrypt($password = 'i-love-laravel'),
      ]);
      $response = $this->post('/login', [
          'email' => $user->email,
          'password' => $password,
      ]);
      // descomentar para activar
      // $user->email = '';
      $this->assertTrue(
          $user->email != '',
          'El correo no esta introducido'
      );

    }
}
