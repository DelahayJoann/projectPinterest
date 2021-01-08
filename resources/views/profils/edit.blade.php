@extends('layouts.profil')

@if (isset($title))
    @section('title', $title)
@else
    @section('title','Edition de profil')
@endif

@section('content')
<div class="container">
    Avatar: {{ Html::image($profil->urlAvatar) }}
    Cover: {{ Html::image($profil->urlCover) }}
    <form action="/profils/edit/{{ $profil['id'] }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}

        <div class="form-group row">
            <label for="urlAvatar" class="col-md-12 col-form-label">Nouvelle avatar: </label>
            <div class="col-md-12">
                <input type="file" class="form-control" name="urlAvatar" id="urlAvatar" value="{{ $profil['urlAvatar'] }}">
                @if($errors->has('urlAvatar'))
                    <small class="error">{{ $errors->first('urlAvatar') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="urlCover" class="col-md-12 col-form-label">Nouvelle cover: </label>
            <div class="col-md-12">
                <input type="file" class="form-control" name="urlCover" id="urlCover" value="{{ $profil['urlCover'] }}">
                @if($errors->has('urlCover'))
                    <small class="error">{{ $errors->first('urlCover') }}</small>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="nom" class="col-md-12 col-form-label">Nom: </label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="nom" id="nom" value="{{ $profil['nom'] }}">
                @if($errors->has('nom'))
                    <small class="error">{{ $errors->first('nom') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="prenom" class="col-md-12 col-form-label">Prénom: </label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="prenom" id="prenom" value="{{ $profil['prenom'] }}">
                @if($errors->has('prenom'))
                    <small class="error">{{ $errors->first('prenom') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="pseudo" class="col-md-12 col-form-label">Pseudo: </label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="pseudo" id="pseudo" value="{{ $profil['pseudo'] }}">
                @if($errors->has('pseudo'))
                    <small class="error">{{ $errors->first('pseudo') }}</small>
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