@extends('layouts.post')

@if (isset($title))
    @section('title', $title)
@else
    @section('title','Affichage de post')
@endif

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>{{ $post['title'] }}</h2>
            <div>{{ Html::image($post->imgUrl) }}</div>
            <p>Description de l'image:</p>
            <p>{{  $post['description'] }}</p>
            <p>Auteur du post:</p>
            <p>{{  $user[0]['pseudo'] }}</p>
        </div>
    </div>
    <div class="row">
        <a href="/post/edit/{{ $post['id'] }}" class="btn btn-primary">Éditer</a>
        <a href="/post/delete/{{ $post['id'] }}" class="btn btn-primary">Supprimer</a>
    </div>
</div>
@endsection