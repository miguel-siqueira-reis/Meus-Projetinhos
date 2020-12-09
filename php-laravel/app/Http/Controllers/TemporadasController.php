<?php

namespace App\Http\Controllers;

use App\Serie;
use App\User;
use Illuminate\Support\Facades\Auth;

class TemporadasController extends Controller
{
    public function index(Int $serieId)
    {
        $user = User::query()->where('id', Auth::id())->first();

        $serie = $user->series()->find($serieId);
        $temporadas = $serie->temporadas;

        return view('temporadas.index', compact('temporadas', 'serie'));
    }
}
