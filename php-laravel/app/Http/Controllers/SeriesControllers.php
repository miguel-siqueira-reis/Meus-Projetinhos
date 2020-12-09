<?php
namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\TableWithTemp;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesControllers extends Controller {

    private $user;

    public function index(Request $request) {
        $this->user = User::find(Auth::user()->id);

        $series = $this->user->series()->orderBy('nome')->get();

        $mensagem = $request->session()->get('mensagem');

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, TableWithTemp $tableWithTemp)
    {
        $this->user = User::find(Auth::user()->id);
        $nome = $request->nome;
        $temp = filter_var($request->temporadas, FILTER_SANITIZE_NUMBER_INT);
        $eps = filter_var($request->episodios, FILTER_SANITIZE_NUMBER_INT);

        $serie = $tableWithTemp->create($nome, $temp, $eps, $this->user->series());

        $request->session()->flash('mensagem', "$nome adicionada com sucesso.");

        return redirect()->route('get_series');
    }

    public function destroy(Request $request, TableWithTemp $tableWithTemp)
    {

        $this->user = User::find(Auth::user()->id);

        $id = filter_var($request->id, FILTER_SANITIZE_NUMBER_INT);
        /** @var Serie $serie */

        $serie = $this->user->getSeriesForId($id);

        //$tableWithTemp->delete(Serie::class, $id);

        foreach ($serie as $serieId) {
            $serie = $serieId;
        }

        Serie::destroy($id);

        $request->session()->flash('mensagem', "{$serie->nome} foi deletada com sucesso.");

        return redirect()->route('get_series');

    }

    public function updateName(Request $request, int $serieId)
    {
        $this->user = User::find(Auth::user()->id);
        $newName = $request->nome;

        $serie = $this->user->series->find($serieId);

        $serie->nome = $newName;
        $serie->save();

    }


}
