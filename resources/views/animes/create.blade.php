@extends('layouts.main')

@section('title')
    Create
@endsection

@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('animes.index')}}">Home</a></li>
        <li class="breadcrumb-item active">Criação de animes</li>
    </ol>
</nav>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form method="post" action="{{route('animes.store')}}">
    @csrf
    <div class="form-group mb-3">
        <div class="row">
            <div class="col col-8">
                <label for="name">Nome:</label>
                <input
                    id="name"
                    name="name"
                    class="form-control"
                />
            </div>

            <div class="col col-2">
                <label for="seasons">Temporadas</label>
                <input
                    id="seasons"
                    name="seasons"
                    class="form-control"
                    type="number"
                />
            </div>
            <div class="col col-2">
                <label for="episodes">Episodios</label>
                <input
                    id="episodes"
                    name="episodes"
                    class="form-control"
                    type="number"
                />
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-dark">Criar Anime</button>
</form>

@endsection
