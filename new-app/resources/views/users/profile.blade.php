<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('title', 'Profil Utilisateur')

@section('content')
<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{ route('Acceuile') }}" class="list-group-item list-group-item-action">Accueil</a>
            <a href="{{ route('about') }}" class="list-group-item list-group-item-action">À propos</a>
            <a href="{{ route('advice') }}" class="list-group-item list-group-item-action">Conseil</a>
            <a href="{{ route('services') }}" class="list-group-item list-group-item-action">Service</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9">
        <h2>Profil de l'utilisateur</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('user.update') }}" method="POST">
    @csrf
    

    <!-- Hidden field for user ID -->
    <input type="hidden" name="id" value="{{ auth()->user()->id }}">

    <div class="form-group">
        <label for="name">Nom :</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required autocomplete="name">
    </div>

    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required autocomplete="email">
    </div>

    <div class="form-group">
        <label for="phone">Téléphone :</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}" required autocomplete="tel">
    </div>

    <div class="form-group">
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmer le mot de passe :</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
    </div>
</div>
@endsection

</body>
</html>
