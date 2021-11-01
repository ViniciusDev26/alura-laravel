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
        {{$anime->name}}

        <div class="d-flex">
            <a href="{{route('seasons.show', ["animeId" => $anime->id])}}" class="btn btn-secondary mr-2">
                <i class="bi bi-pencil-square"></i>
            </a>

            <form method="post" action="{{route('animes.destroy', ['anime' => $anime->id])}}" onsubmit="return confirm('Tem certeza?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
            </form>
        </div>
    </li>


    @endforeach
</ul>

<a class="btn btn-dark mt-2 mb-2" href="{{route('animes.create')}}">Criar Anime</a>

@endsection
