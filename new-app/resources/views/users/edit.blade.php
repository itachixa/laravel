@extends('layouts.app')

@section('title', 'Modifier l\'Utilisateur')

@section('content')
<div id="user-form">
    <h2>Modifier l'utilisateur</h2>

    <div id="alert-container"></div>

    <form id="edit-user-form" action="#" method="POST" style="display: none;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="phone">Téléphone :</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="address">Adresse :</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const userId = "{{ $user->id ?? '' }}";

        if (userId) {
            fetch(`/api/user/${userId}`)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('edit-user-form').action = `/user/update/${data.id}`;
                        document.getElementById('name').value = data.name;
                        document.getElementById('email').value = data.email;
                        document.getElementById('phone').value = data.phone;
                        document.getElementById('address').value = data.address;
                        document.getElementById('edit-user-form').style.display = 'block';
                    } else {
                        displayError('Les données de l\'utilisateur sont introuvables.');
                    }
                })
                .catch(error => {
                    displayError('Erreur lors du chargement des données de l\'utilisateur.');
                });
        } else {
            displayError('L\'utilisateur n\'est pas défini.');
        }

        function displayError(message) {
            const alertContainer = document.getElementById('alert-container');
            alertContainer.innerHTML = `<div class="alert alert-danger">${message}</div>`;
        }
    });
</script>
@endsection
