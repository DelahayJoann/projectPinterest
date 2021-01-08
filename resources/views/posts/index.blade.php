@extends('layouts.post')

@if (isset($title))
    @section('title', $title)
@else
    @section('title','Liste des posts')
@endif

@section('content')
<table class="table">
        <thead>
            <tr>
                <th>image</th>
                <th>description</th>
            </tr>
        </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td>{{ Html::Image($post->imgUrl) }}</td>
            <td>{{ $post->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection