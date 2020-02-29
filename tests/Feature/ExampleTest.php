<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use App\Movie;

use Illuminate\Http\UploadedFile;

use Illuminate\Foundation\Testing\WithFaker;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // public function testBasicTest()
    // {
    //     $response = $this->get('/');
    //
    //     $response->assertStatus(302);
    // }



    /** @test */
    // todas las peliclas
    public function todo_el_catalogo(){
      $this->withoutMiddleware();
      $response = $this->get('/catalog');
      // $data = $response->getOriginalContent()->getData();
      // $response->assertSuccessful();
      $response->assertViewIs('catalog.index');
    }


    /** @test */
    // solo la primera pelicula
    public function primera_pelicula_catalogo(){
      // es necesario registrarte
      $user = factory(User::class)->create([
          'password' => bcrypt($password = 'i-love-laravel'),
      ]);

      $response = $this->post('/login', [
          'email' => $user->email,
          'password' => $password,
      ]);
      $this->withoutExceptionHandling();
      $response = $this->get('/catalog/show/1');
      $response->assertViewIs('catalog.show');

    }


    /** @test */
    // crear un comentario vacio
    public function crear_comentario_vacio(){
      // simular que estas logeado
      $user = factory(User::class)->create([
          'password' => bcrypt($password = 'i-love-laravel'),
      ]);

      $response = $this->post('/login', [
          'email' => $user->email,
          'password' => $password,
      ]);
      // crear el comentario
      $response = $this->post('/catalog/comment/1',[
        'title' => '',
        'review' => '',
        'stars' => '',
        'user_id' => '',
        'movie_id' => '',
      ]);
      // mirar si hay algo en la base de datos como esto
      // ( si salta error es que no se peude insertar)

      // descomentar para activar

      $this->assertDatabaseHas('reviews',[
        'title' => '',
        'review' => '',
        'stars' => '',
        'user_id' => '',
        'movie_id' => '',
      ]);
    }


    /** @test */
    // Crear un comentairo bien
    public function crear_comentario_bien(){
      // simular que estas logeado
      $user = factory(User::class)->create([
          'password' => bcrypt($password = 'i-love-laravel'),
      ]);

      $response = $this->post('/login', [
          'email' => $user->email,
          'password' => $password,
      ]);
      // crear el comentario vacio
      $response = $this->post('/catalog/comment/1',[
        'title' => 'TesteoDesDeLaravel',
        'review' => 'Las he visto mejores',
        'stars' => '5',
        'user_id' => '1',
        'movie_id' => '1',
      ]);
      // mirar si hay algo en la base de datos como esto
      $this->assertDatabaseHas('reviews',[
        'title' => 'TesteoDesDeLaravel'
      ]);
    }


    /** @test */
    // NO ESTA HECHO
    public function cambiar_una_pelicula(){
      // simular que estas logeado
      // $user = factory(User::class)->create([
      //     'password' => bcrypt($password = 'i-love-laravel'),
      // ]);
      //
      // $response = $this->post('/login', [
      //     'email' => $user->email,
      //     'password' => $password,
      // ]);
      // no puedes estar logeado
      $this->withoutMiddleware();

      // Crear pelicula sino no va
      // $movie = factory(Movie::class)->create();

      // hacer la modificacion
      $response = $this->put('/catalog/edit/1',[
        'title' => 'Cambiado'
      ]);
      // $response = $this->json('PUT','/catalog/edit/1', [
      //           'title' => 'El padrinoo'
      //       ]);
      $response->assertStatus(302);
      //$response->assertJson('as');

      // $data = $response->getOriginalContent()->getData();
      // dd($data);
      //
      //

      // mirar si hay algo en la base de datos como esto
      // $this->assertDatabaseHas('movies',[
      //   'title' => 'El padrinoo'
      // ]);
    }


    /** @test */
    // Crear pelicula vacia
    public function crear_pelicula_vacia(){
      // simular que estas logeado
      $user = factory(User::class)->create([
          'password' => bcrypt($password = 'i-love-laravel'),
      ]);

      $response = $this->post('/login', [
          'email' => $user->email,
          'password' => $password,
      ]);
      // crear el comentario
      $response = $this->post('/catalog/create',[
        'title' => '',
        'year' => '',
        'director' => '',
        'poster' => '',
        'rented' => '',
        'synopsis' => '',
        'category_id' => '',
        'trailer' => '',
      ]);
      // mirar si hay algo en la base de datos como esto
      // ( si salta error es que no se peude insertar)

      $this->assertDatabaseHas('movies',[
        'title' => '',
        'year' => '',
        'director' => '',
        'poster' => '',
        'rented' => '',
        'synopsis' => '',
        'category_id' => '',
        'trailer' => '',
      ]);
    }


    // Crear pelicula via API
    /** @test */
    public function crear_pelicula_bien_por_api(){
      //$user = factory(User::class)->create();
      // no necesitas logeo asi
      $this->withoutMiddleware();
      // $response = $this->actingAs($user, 'api')->json('POST','/api/v1/catalog', [
      $response = $this->json('POST','/api/v1/catalog', [
              'title' => 'Testeo',
              'year' => 2020,
              'director' => 'Hector Naranjo',
              'poster' => UploadedFile::fake()->image('image.jpg'),
              'rented' => 0,
              'synopsis' => 'Es un test des de la API',
              'category_id' => 1,
              'trailer' => 'noTiene'
            ]);
        $this->assertDatabaseHas('movies',[
            'director' => 'Hector Naranjo'
          ]);
    }


    // Poner en alquilado o no
    /** @test */
    public function poner_en_alquilada(){
      // no necesitas logeo asi
      $this->withoutMiddleware();
      $response = $this->json('PUT','api/v1/catalog/1/rent');
      $response->assertStatus(200);
      $response->assertJson(['msg' => "La película se ha marcado como alquilada"]);

    }
    /** @test */
    public function poner_en_devuleta(){
      // no necesitas logeo asi
      $this->withoutMiddleware();
      $response = $this->json('PUT','api/v1/catalog/1/return');
      $response->assertStatus(200);
      $response->assertJson(['msg' => "La película se ha marcado como no alquilada"]);

    }

}
