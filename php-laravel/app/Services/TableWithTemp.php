<?php

namespace App\Services;


use App\Episodio;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class TableWithTemp
{
    public function create(string $nome, int $temp, int $eps, $table)
    {
        DB::beginTransaction();
        $column = $table->create([
            'nome' => $nome
        ]);

        for($i = 1; $i <= $temp; $i++) {
            $temporada = $column->temporadas()->create(['numero' => $i]);
            for($ie = 1; $ie <= $eps; $ie++) {
                $temporada->episodios()->create(['numero' => $ie]);
            }
        }
        DB::commit();

        return $column;
    }

    public function delete($table, $id)
    {
        DB::beginTransaction();
        $table->temporadas->each(function (Temporada $temporada) {
            $temporada->episodios->each(function(Episodio $episodio) {
                $episodio->delete();
            });
            $temporada->delete();
        });
        $table::destroy($id);
        DB::commit();

    }
}
