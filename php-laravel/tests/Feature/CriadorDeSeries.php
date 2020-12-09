<?php

namespace Tests\Feature;

use App\Serie;
use App\Services\TableWithTemp;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CriadorDeSeries extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $criadorDeSerie = new TableWithTemp();
        $nomeSerie = 'Nome de teste';
        $serieCriada = $criadorDeSerie->create($nomeSerie, 1, 1, Serie::class);

        $this->assertInstanceOf(Serie::class, $serieCriada);
        $this->assertDatabaseHas('series', ['nome' => $nomeSerie]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serieCriada->id, 'numero'=> 1]);
        $this->assertDatabaseHas('episodios', ['numero'=> 1]);

    }
}
