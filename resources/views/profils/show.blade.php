@extends('layouts.profil')

@if (isset($title))
    @section('title', $title)
@else
    @section('title','Profil')
@endif

@section('content')
        <h2>Pseudo: {{ $profil->pseudo }}</h2>
        <p>Nom: {{ $profil->nom }} Prénom: {{ $profil->prenom }}</p>
        <p>Avatar: {{ Html::image($profil->urlAvatar) }}</p>
        <p>Cover: {{ Html::image($profil->urlCover) }}</p>
        <p><a href="/profils/edit/{{ $profil->id }}" class="btn btn-primary">Edit</a></p>
        <p><a href="/profils/destroy/{{ $profil->id }}" class="btn btn-primary">Supprimer</a></p>
@endsection