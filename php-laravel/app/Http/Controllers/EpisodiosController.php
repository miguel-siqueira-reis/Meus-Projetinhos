<?php


namespace App\Http\Controllers;

use App\Episodio;
use App\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{

    public function assistir(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = [];
        $episodiosAssistidos = explode(',',$request->assistidoId);

        $temporada->episodios->each(function (Episodio $episodio)
        use ($episodiosAssistidos)
        {
            echo (in_array(
                $episodio->id,
                $episodiosAssistidos
            ));
            var_dump($episodiosAssistidos);

            $episodio->assistido = in_array(
                $episodio->id,
                $episodiosAssistidos
            );
        });

        $temporada->push();


    }
}
