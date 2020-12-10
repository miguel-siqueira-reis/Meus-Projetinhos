@extends('layout')

@section('titleDocument')
    Lista de temporadas
@endsection


@section('heade')
<style>
        ul.list-temp {
            margin-bottom: 5rem;
            overflow: hidden;
        }

        .item-temp {
            font-size: 1.5rem;

        }

        .item-ep {
            font-size: 1rem;
            transition: all 0.5s ease-in-out;

        }

        .list-eps {
            transform: translateX(110%);
            animation: openEps .5s ease-in-out forwards 0.1s;
        }

        @keyframes openEps {
            to {
                transform: translateX(0px);

            }
        }

        .count {
            height: 1.5rem;
        }
</style>
@endsection


@section('title')
    Temporadas de {{ $serie->nome }}
@endsection


{{--//se tivesse dois codigos indenticos no meu blade eu poderia fazer isso:
   @include('nomeDoBladeExtra', ['varQueEleUtiliza' => $varQueEleUtiliza])

   e também poderia deixar uma condição:
   @includeWhen( condição ,'nomeDoBladeExtra', ['varQueEleUtiliza' => $varQueEleUtiliza])

--}}


@section('content')
    <ul class="list-group list-temp w-80 w-auto">
        <p style="display: none">{{ $iT = 0 }}</p>
        @foreach ($temporadas as $temporada)
        <p style="display: none">{{ $iT++ }}</p>
        <li class="list-group-item item-temp item-temp-{{ $temporada->id }}">
            <div class="d-flex justify-content-between" onclick="openEps({{ $temporada->id }})"><p>{{ $temporada->numero }}° Temporada</p><div class="badge badge-secondary count"><span class="i count-{{ $temporada->id }}">{{ $temporada->getEpsAssistidos()->count() }}</span> / {{ $temporada->episodios->count() }}</div></div>
            <ul id="eps-{{ $temporada->id }}" class="list-eps p-0" hidden>
                <p style="display: none">{{ $i = 0 }}</p>
                @foreach ($temporada->episodios as $eps)
                    <p style="display: none">{{ $i++ }}</p>
                <li id="ep-{{$i}}" class="d-flex justify-content-between p-2 item-ep">
                    @if(!empty($link))
                        <a href="{{ $link[$iT-1][$i-1] }}" onclick="checkDataLink(this, {{ $temporada->id }}, {{ $eps->id }})" target="_blank">Episodio {{$i}}</a>
                    @else
                        Episodio {{$i}}
                    @endif
                    @auth()
                    <input class="check-{{ $temporada->id }}-{{ $eps->id }}" onclick="checkData(this, {{ $temporada->id }}, {{ $eps->id }})" {{ $eps->assistido? "data-check-{$temporada->id}={$eps->id} checked": '' }} type="checkbox">
                    @csrf
                    @endauth
                </li>
                @endforeach
            </ul>
        </li>
        @endforeach
    </ul>
@endsection



@section('javaScript')
    <script>
        function openEps(id) {
            const ul = document.querySelector(`#eps-${id}`)

            if (ul.hasAttribute('hidden')) {
                ul.removeAttribute('hidden')
            } else {
                ul.hidden = true;
            }

        }

        function checkDataLink(targetLink, idCountTemp, idEp) {
            const input = document.querySelector(`.check-${idCountTemp}-${idEp}`);
            if (!input.hasAttribute('checked') || !input.hasAttribute(`data-check-${idCountTemp}`)) checkData(input, idCountTemp, idEp);
            input.setAttribute('checked', "");
            input.checked = true;
            console.log(input)
        }

        function checkData(target, idCountTemp, idEp) {
            let i = 0;
            const count = document.querySelector(`.count-${idCountTemp}`);
            const checado = target;
            console.log(target)
            if (checado.hasAttribute(`data-check-${idCountTemp}`)) {
                checado.removeAttribute(`data-check-${idCountTemp}`)
                i--
            } else {
                i++
                checado.setAttribute(`data-check-${idCountTemp}`, idEp.toString())
            }
            count.textContent = i+parseInt(count.textContent);

            const formData = new FormData();

            const token = document.querySelector('[name=_token]').value;

            const check = document.querySelectorAll(`[data-check-${idCountTemp}]`);
            let arrayAssistido = []
            console.log(check)
            check.forEach(cheka => arrayAssistido.push(cheka.dataset[`check-${idCountTemp}`]));
            console.log(arrayAssistido)
            formData.append('assistidoId', arrayAssistido);
            formData.append('_token', token);

            const url = `/temporadas/${idCountTemp}/assistir`;
            fetch(url, {
                body: formData,
                method: 'POST'
            })

            console.log('oi')
        }
    </script>
@endsection
