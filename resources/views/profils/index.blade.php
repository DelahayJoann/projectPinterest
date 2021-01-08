@extends('layouts.profil')

@if (isset($title))
    @section('title', $title)
@else
    @section('title','Profils')
@endif

@section('content')
<a href="/profils/create/">Créer</a>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Pseudo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>  
    @foreach($profils as $profil)
        <tr>
            <td scope="row">{{ $profil->id }}</td>
            <td>{{ $profil->nom }}</td>
            <td>{{ $profil->prenom }}</td>
            <td>{{ $profil->pseudo }}</td>
            <td>
                <a href="/profils/show/{{ $profil->id }}">afficher</a><br/>
                <a href="/profils/edit/{{ $profil->id }}">modifier</a><br/>
                <a href="/profils/destroy/{{ $profil->id }}">supprimer</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection