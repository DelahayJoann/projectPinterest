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
        </div>
    </div>
    <div class="row">
        <a href="/post/edit/{{ $post['id'] }}" class="btn btn-warning">Éditer</a>
        <form method="POST" action="/post/delete/{{ $post['id'] }}">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
            <div class="form-group">
                <input type="submit" value="Supprimer" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>
@endsection