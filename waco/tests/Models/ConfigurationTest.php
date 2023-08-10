<?php

namespace Tests\Models;

use App\Models\Configuration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_configuration()
    {

        $configuration = Configuration::create([
            'url' => 'https://pokeapi.co/api/v2/pokemon',
            'amount_pokemon' => 1000,
            'option' => 1,
        ]);

        $retrievedConfiguration = Configuration::find($configuration->id);


        $this->assertEquals('https://pokeapi.co/api/v2/pokemon', $retrievedConfiguration->url);
        $this->assertEquals(1000, $retrievedConfiguration->amount_pokemon);
        $this->assertEquals(1, $retrievedConfiguration->option);
    }
}
