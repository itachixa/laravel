<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos</title>
</head>
<body>
@extends('users.profile')



@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{ route('Acceuil') }}" class="list-group-item list-group-item-action">Accueil</a>
            <a href="{{ route('about') }}" class="list-group-item list-group-item-action active">À propos</a>
            <a href="{{ route('advice') }}" class="list-group-item list-group-item-action">Conseil</a>
            <a href="{{ route('services') }}" class="list-group-item list-group-item-action">Service</a>
            <a href="{{ route('Acceuile') }}" class="list-group-item list-group-item-action">Paramètres</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9">
        <h2>À propos de nous</h2>
        <p>Contenu de la page À propos...</p>
    </div>
</div>
@endsection

</body>
</html>
