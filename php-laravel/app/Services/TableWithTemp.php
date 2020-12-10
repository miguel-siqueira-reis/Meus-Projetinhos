<?php

namespace App\Services;


use App\Episodio;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class TableWithTemp
{
    public function create(string $nome, int $temp, int $eps, $link, $table)
    {
        DB::beginTransaction();
        $column = $table->create([
            'nome' => $nome
        ]);
        $zero = 0;

        if(!empty($link)) {
            $link = str_replace('$*', $zero."*", $link);
            $link = str_replace('$^', $zero."^", $link);
        }
        $back = true;

        for($i = 1; $i <= $temp; $i++) {
            $iT = $i-1;
            $temporada = $column->temporadas()->create(['numero' => $i]);
            if (!empty($link)) $link = str_replace($iT."*", $i."*", $link);
            for($ie = 1; $ie <= $eps; $ie++) {
                if (!empty($link)) {
                    if($back) $link = str_replace($eps.'^', $zero."^", $link);
                    $back = false;
                    $ieE = $ie-1;
                    $link = str_replace($ieE."^", $ie."^", $link);

                    $temporada->episodios()->create(['numero' => $ie, 'link' => $link]);
                } else {
                    $temporada->episodios()->create(['numero' => $ie]);
                }
                $back = true;
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
