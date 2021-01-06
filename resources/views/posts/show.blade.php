@extends('layouts.post')

@if (isset($title))
    @section('title', $title)
@else
    @section('title','Affichage de post')
@endif

@section('content')
<img src="{{ $post['imgUrl'] }}" alt="">
<h2>{{ $post['title'] }}</h2>
<p>{{  $post['description'] }}</p>

<a href="/post/edit/{{ $post['id'] }}" class="btn btn-warning">éditer</a>

<form method="POST" action="/post/delete/{{ $post['id'] }}">
{{ csrf_field() }}
{{ method_field('DELETE') }}
    <div class="form-group">
        <input type="submit" value="Supprimer" class="btn btn-danger">
    </div>
</form>

@endsection