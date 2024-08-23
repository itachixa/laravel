<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
</head>
<body>
@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="row">
    <!-- Sidebar -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="{{ route('Acceuile') }}" class="list-group-item list-group-item-action">Accueil</a>
            <a href="{{ route('about') }}" class="list-group-item list-group-item-action">À propos</a>
            <a href="{{ route('advice') }}" class="list-group-item list-group-item-action">Conseil</a>
            <a href="{{ route('services') }}" class="list-group-item list-group-item-action active">Service</a>
            <a href="{{ route('Acceuil') }}" class="list-group-item list-group-item-action">Paramètres</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="col-md-9">
        <h2>Nos services</h2>
        <p>Contenu de la page Service...</p>
    </div>
</div>
@endsection

</body>
</html>
