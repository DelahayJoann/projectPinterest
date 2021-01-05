@extends('layouts.profil')

@if (isset($title))
    @section('title', $title)
@else
    @section('title','Création de profil')
@endif

@section('content')
<div class="container">
    <form action="/profils/create" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
        <div class="form-group row">
            <label for="nom" class="col-md-12 col-form-label">Nom: </label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="nom" id="nom" placeholder="" value="{{ old('nom') }}">
                @if($errors->has('nom'))
                    <small class="error">{{ $errors->first('nom') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="nom" class="col-md-12 col-form-label">Prenom: </label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="" value="{{ old('prenom') }}">
                @if($errors->has('prenom'))
                    <small class="error">{{ $errors->first('prenom') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="nom" class="col-md-12 col-form-label">Pseudo: </label>
            <div class="col-md-12">
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="" value="{{ old('pseudo') }}">
                @if($errors->has('pseudo'))
                    <small class="error">{{ $errors->first('pseudo') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="nom" class="col-md-12 col-form-label">Avatar (facultatif): </label>
            <div class="col-md-12">
                <input type="file" class="form-control" name="urlAvatar" id="urlAvatar" placeholder="" value="{{ old('urlAvatar') }}">
                @if($errors->has('avatarUrl'))
                    <small class="error">{{ $errors->first('urlAvatar') }}</small>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="nom" class="col-md-12 col-form-label">Profil cover (facultatif): </label>
            <div class="col-md-12">
                <input type="file" class="form-control" name="urlCover" id="urlCover" placeholder="" value="{{ old('urlCover') }}">
                @if($errors->has('urlCover'))
                    <small class="error">{{ $errors->first('urlCover') }}</small>
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