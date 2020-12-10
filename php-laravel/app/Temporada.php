<?php
namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    public $timestamps = false;
    protected $fillable = ['numero'];

    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getEpsAssistidos()
    {
        return $this->episodios->filter(function(Episodio $episodio) {
            return $episodio->assistido;
        });

    }

    public function hasLinkEps()
    {
        $array = [];
        foreach ($this->episodios as $episodio) {
            if (!empty($episodio->link)) {
                $link = $episodio->link;
                $link = str_replace('*','', $link);
                $link = str_replace('^','', $link);
                $array[] = $link;
            }
        }
        return $array;
    }
}
