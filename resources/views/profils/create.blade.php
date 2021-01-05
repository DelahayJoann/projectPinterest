@extends('layouts.profil')

@if (isset($title))
    @section('title', $title)
@else
    @section('title','Création de profil')
@endif

<!-- @section('nav')
    @foreach($navElements as $navElement)
        <a href="{{$navElement['href']}}">{{$navElement['name']}}</a>
    @endforeach
@endsection -->

@section('content')
<div class="container">
    <form action="/profils/create" method="POST">
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
                <input type="text" class="form-control" name="nom" id="nom" placeholder="" value="{{ old('nom') }}">
                @if($errors->has('nom'))
                    <small class="error">{{ $errors->first('nom') }}</small>
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