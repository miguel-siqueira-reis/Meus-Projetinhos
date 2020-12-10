@extends('layout')

@section('titleDocument')
Adicionar Nova Série
@endsection

@section('title')
Adicionar Série
@endsection

@section('heade')
    <style>
        .input-group-link {
            padding-left: -10rem;
            margin: 1rem -1rem;
        }
        .check {
            margin-top: 3rem;
        }

        .label__check {
            transform: translateY(-5px);
        }

        .col-link {
            display: none;
        }
    </style>
@endsection

@section('content')
    @include('errors', ['erros' => $errors])

    <form method="POST">
    @csrf

        <div class="row">
            <div class="col col-8">
                <label for="nome">Nome da Série:</label>
                <input type="text" id="nome" name="nome" class="form-control w-100">
            </div>
            <div class="col col-2">
                <label for="temporadas">N° de Temp:</label>
                <input type="number" id="temporadas" name="temporadas" class="form-control w-100">
            </div>
            <div class="col col-2">
                <label for="episodios">N° de eps por Temp:</label>
                <input type="number" id="episodios" name="episodios" class="form-control w-100">
            </div>
        </div>
        <input type="checkbox" id="check" class="check">
        <label for="check" class="label__check">Obter o link dos episodios ao clicar nos episodios</label>
        <div class="input-group-link row">
            <div class="col col-9 col-link">
                <label for="input-link">link do primeiro ep:</label>
                <input type="text" id="link" name="link" class="form-control w-100">
                <span>coloque o link do primeiro episodio é no lugar do variante da temporada coloque $T<br> e no lugar do variante do episodio coloque $E.</span>
            </div>

        </div>
        <button class="btn btn-primary mt-2">Adicionar</button>
    </form>
@endsection


@section('javaScript')
    <script>
        const check = document.querySelector('#check')
        const col = document.querySelector('.col-link');
        check.checked = false;
        check.addEventListener('click', e => {
            if (!e.target.cheked) {
                col.style = "display: block;";
                e.target.cheked = true;
            } else {
                col.style = "display: none;"
                e.target.cheked = false;
            }
        })

    </script>
@endsection
