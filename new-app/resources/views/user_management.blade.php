<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire des utilisateurs</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .form-section {
            display: none; /* Masquer les sections par défaut */
        }
        .form-section.active {
            display: block; /* Afficher la section active */
        }
        .user-list, .search-results {
            margin-top: 20px;
        }
        .user-list ul, .search-results ul {
            list-style-type: none;
            padding: 0;
        }
        .user-list li, .search-results li {
            border-bottom: 1px solid #ddd;
            padding: 8px 0;
        }
        .user-list button {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>Gestionnaire des utilisateurs</h1>
    <br>
    <div class="row">
        <div class="col">
            <h2>Veuillez choisir une option de gestion de compte</h2>
            <button class="button-add" onclick="showForm('add')">Ajouter un compte</button>
            <button class="button-modify" onclick="showForm('modify')">Modifier un compte</button>
            <button class="button-delete" onclick="showForm('delete')">Supprimer un compte</button>
            <button class="button-list" onclick="showForm('list')">Lister tous les comptes</button>
        </div>
        <div class="col">
            <!-- Formulaire d'ajout -->
            <div id="add-form" class="form-section">
                <h3>Ajouter un compte</h3>
                <form id="add-form-action" method="POST" action="{{ route('users.store') }}">
                    @csrf
                    <input type="text" name="name" placeholder="Nom" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="phone" placeholder="Numéro de téléphone">
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                    <button type="button" onclick="submitForm('add-form-action')">Ajouter</button>
                </form>
            </div>

            <!-- Formulaire de modification -->
            <div id="modify-form" class="form-section">
                <h3>Modifier un compte</h3>
                <form id="modify-form-action" method="POST" action="{{ route('users.update', ':id') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="update-id">
                    <input type="text" name="name" id="update-name" placeholder="Nom">
                    <input type="text" name="phone" id="update-phone" placeholder="Numéro de téléphone">
                    <input type="password" name="password" id="update-password" placeholder="Mot de passe">
                    <input type="password" name="password_confirmation" id="update-password-confirmation" placeholder="Confirmer le mot de passe">
                    <button type="button" onclick="submitForm('modify-form-action')">Modifier</button>
                </form>
            </div>

            <!-- Formulaire de suppression -->
            <div id="delete-form" class="form-section">
                <h3>Supprimer un compte</h3>
                <div id="delete-options" class="user-list">
                    <!-- Liste des comptes pour la suppression -->
                </div>
                <form id="delete-form-action" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="delete-id">
                    <button type="button" onclick="submitForm('delete-form-action')">Supprimer</button>
                </form>
            </div>

            <!-- Liste des comptes -->
            <div id="list-form" class="form-section">
                <h3>Liste des comptes</h3>
                <div id="user-list" class="user-list">
                    <!-- Liste des comptes -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function showForm(formId) {
            // Masquer toutes les sections
            const sections = document.querySelectorAll('.form-section');
            sections.forEach(section => section.classList.remove('active'));

            // Afficher la section sélectionnée
            const selectedSection = document.getElementById(`${formId}-form`);
            if (selectedSection) {
                selectedSection.classList.add('active');

                // Charger les données pour les sections appropriées
                if (formId === 'list') {
                    loadUserList();
                } else if (formId === 'delete') {
                    loadDeleteOptions();
                }
            }
        }

        async function submitForm(formId) {
            const form = document.getElementById(formId);
            const formData = new FormData(form);
            const method = formId === 'delete-form-action' ? 'DELETE' : formId === 'modify-form-action' ? 'PUT' : 'POST';

            try {
                const url = form.action.replace(':id', document.getElementById('update-id')?.value || document.getElementById('delete-id')?.value);
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                });

                const result = await response.json();

                if (response.ok) {
                    alert(result.message || 'Opération réussie!');
                    if (formId === 'list-form') {
                        loadUserList();
                    }
                } else {
                    alert('Erreur: ' + (result.message || 'Une erreur est survenue.'));
                }
            } catch (error) {
                console.error('Erreur lors de l\'envoi de la requête:', error);
                alert('Erreur lors de l\'envoi de la requête.');
            }
        }

        async function loadUserList() {
            try {
                const response = await fetch('{{ route('users.list') }}'),
                const data = await response.json();
                const userList = document.getElementById('user-list');
                userList.innerHTML = data.map(user => `
                    <div>${user.name} (${user.email})
                        <button onclick="selectUser('${user.id}', '${user.name}', '${user.phone}')">Sélectionner</button>
                    </div>
                `).join('');
            } catch (error) {
                console.error('Erreur lors du chargement des utilisateurs:', error);
            }
        }

        function selectUser(id, name, phone) {
            document.getElementById('update-id').value = id;
            document.getElementById('update-name').value = name;
            document.getElementById('update-phone').value = phone;
            showForm('modify');
        }

        async function loadDeleteOptions() {
            try {
                const response = await fetch('{{ route('users.list') }}');
                const data = await response.json();
                const deleteOptions = document.getElementById('delete-options');
                deleteOptions.innerHTML = data.map(user => `
                    <div>${user.name} (${user.email})
                        <button onclick="confirmDelete('${user.id}')">Sélectionner</button>
                    </div>
                `).join('');
            } catch (error) {
                console.error('Erreur lors du chargement des utilisateurs pour suppression:', error);
            }
        }

        function confirmDelete(id) {
            document.getElementById('delete-id').value = id;
            showForm('delete');
        }
    </script>
</body>
</html>
