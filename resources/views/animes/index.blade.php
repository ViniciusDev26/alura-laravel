@extends('layouts.main')

@section('title')
    Listagem
@endsection

@section('content')

    @if ($message = Session::get('message'))
        <p class="alert alert-{{Session::get('status') ? 'success' : 'danger'}}">{{$message}}</p>
    @endif


<ul class="list-group">
    @foreach($animes as $anime)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span id="nome-serie-{{ $anime->id }}">{{ $anime->name }}</span>

        <div class="input-group w-50" hidden id="input-nome-serie-{{ $anime->id }}">
            <input type="text" class="form-control" value="{{ $anime->name }}">
            <div class="input-group-append">
                <button class="btn btn-primary" onclick="editarAnime('{{ $anime->id }}')">
                    <i class="bi bi-check-lg"></i>
                </button>
                @csrf
            </div>
        </div>

        <div class="d-flex">
            <button class="btn btn-info mx-2" onclick="toggleInput('{{$anime->id}}')">
                <i class="bi bi-pen"></i>
            </button>

            <a href="{{route('seasons.index', ["animeId" => $anime->id])}}" class="btn btn-secondary mx-2">
                <i class="bi bi-pencil-square"></i>
            </a>

            <form method="post" action="{{route('animes.destroy', ['anime' => $anime->id])}}" onsubmit="return confirm('Tem certeza?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger mx-2"><i class="bi bi-trash"></i></button>
            </form>
        </div>
    </li>

    @endforeach
</ul>

<a class="btn btn-dark mt-2 mb-2" href="{{route('animes.create')}}">Criar Anime</a>

<script>
    function toggleInput(animeId) {
        const inputSerie = document.querySelector(`#input-nome-serie-${animeId}`);
        const nomeSerie = document.querySelector(`#nome-serie-${animeId}`);
        if(nomeSerie.hasAttribute('hidden')){
            nomeSerie.removeAttribute('hidden');
            inputSerie.hidden = true;
        }else {
            inputSerie.removeAttribute('hidden');
            nomeSerie.hidden = true;
        };
    }

    async function editarAnime(animeId){
        const form = new FormData();
        const inputSerieValue = document.querySelector(`#input-nome-serie-${animeId} > input`).value;
        const token = document.querySelector('input[name="_token"]').value;
        form.append('name', inputSerieValue);
        form.append('_token', token);

        const url = `/animes/${animeId}/editName`;
        await fetch(url, {
            body: form,
            method: 'post'
        })

        document.querySelector(`#nome-serie-${animeId}`).innerHTML = inputSerieValue;

        toggleInput(animeId);
    }
</script>

@endsection
