@extends('layouts.profil')

@if (isset($title))
    @section('title', $title)
@else
    @section('title','Profils')
@endif

@section('content')
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Pseudo</th>
            <th>Avatar</th>
            <th>Cover</th>
        </tr>
    </thead>
    <tbody>  
    @foreach($profils as $profil)
        <tr>
            <td scope="row">{{ $profil->id }}</td>
            <td>{{ $profil->nom }}</td>
            <td>{{ $profil->prenom }}</td>
            <td>{{ $profil->pseudo }}</td>
            <td>{{ Html::image(secure_asset($profil->urlAvatar)) }}</td>
            <td>{{ Html::image(secure_asset($profil->urlCover)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection