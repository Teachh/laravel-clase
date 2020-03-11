<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\WithFaker;



class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
   use withFaker;

    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            // Visita la pàgina
            // pongo la URL entera por el tema de que no me deja usar el puerto
            $browser->visit('http://localhost:8000')
                    ->waitForText('Videoclub')
            // Fes un login amb un usuari vàlid
                    ->type('email','user1@email.com')
                    ->type('password','password')
                    ->press('Login')
                    ->assertPathIs('/catalog')
                    ->pause(1000)
            // Fes una cerca d'una pel·lícula que no existeixi
                    ->type('q','Pescado')
                    ->click('#busc')
                    ->pause(1000)
            // Fes una cerca d'una pel·lícula que existeixi
                    ->type('q','Pulp Fiction')
                    ->click('#busc')
                    ->pause(1000)
            // Visualització de la pàgina de detall d'una pel·lícula trobada.
                    ->clickLink('Pulp Fiction')
                    ->pause(1000)
            // Fes un scroll fins al final de la pàgina.
                    ->script("$('html, body').animate({ scrollTop: $('#comForm').offset().top }, 0);");
            // Volver a empezar
            $browser->pause(1000)
            // Afegeix un comentari amb valoració 5 estrelles.
                    ->type('title', 'Des del Dusk')
                    ->select('stars', '5')
                    ->type('review', 'Des del Dusk')
                    ->press('Valorar')
                    ->pause(1000)
            // Afegeix una nova pel·lícula (pots inventar algunes dades amb Faker)
                    ->clickLink('Nueva película')
                    ->assertPathIs('/catalog/create')
                    ->type('title', $this->faker->name)
                    ->type('year', '2020')
                    ->type('director', $this->faker->name)
                    ->type('poster', 'https://images-na.ssl-images-amazon.com/images/I/512sWuPuH-L.jpg')
                    ->type('trailer', 'No')
                    ->type('synopsis', $this->faker->text)
                    ->select('category', '1')
                    ->press('Añadir película')
            // Sortir de la sessió
                    ->pause(5000)
                    ->press('Cerrar sesión')
                    ->assertPathIs('/login')
                    ->pause(1000);
        });
    }
}
