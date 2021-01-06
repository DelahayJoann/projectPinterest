@extends('layouts.post')

@if (isset($title))
    @section('title', $title)
@else
    @section('title','Edition de post')
@endif

@section('content')
<div class="container">
    <form action="/post/create" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="form-group row">
            <label for="image" class="col-md-12 col-form-label">Image: </label>
            <div class="col-md-12">
                <input type="file" class="form-control" name="image" id="image" placeholder="{{ $post['image'] }}">
                @if($errors->has('image'))
                    <small class="error">{{ $errors->first('image') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="title" class="col-md-12 col-form-label">Titre: </label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="title" id="title" placeholder="{{ $post['title'] }}">
                @if($errors->has('title'))
                    <small class="error">{{ $errors->first('title') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="description" class="col-md-12 col-form-label">Description: </label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="description" id="description" placeholder="{{ $post['description'] }}">
                @if($errors->has('description'))
                    <small class="error">{{ $errors->first('description') }}</small>
                @endif
            </div>
        </div>

       
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </form>
</div>
@endsection