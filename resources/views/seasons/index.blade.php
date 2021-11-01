@extends('layouts.main')

@section('title')
    {{$anime->name}} - Seasons
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('animes.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Seasons list</li>
        </ol>
    </nav>

    <h3>{{$anime->name}}</h3>
    <ul class="list-group">
        @foreach($seasons as $season)
            <li class="list-group-item">Season {{$season->number + 1}}</li>
        @endforeach
    </ul>
@endsection
