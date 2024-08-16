<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire des utilisateurs</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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
            <div id="add-form" class="form-section">
                <h3>Ajouter un compte</h3>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Nom" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="text" name="phone" placeholder="Numéro de téléphone" required>
                    <input type="password" name="password" placeholder="Mot de passe" required>
                    <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                    <button class="button-add" type="submit">Ajouter un compte</button>
                </form>
            </div>

            <div id="modify-form" class="form-section">
                <h3>Modifier un compte</h3>
                <form id="modify-form-action" method="POST">
                    @csrf
                    @method('PUT') <!-- Ajout de la méthode PUT pour la mise à jour -->
                    <input type="hidden" name="id" id="update-id">
                    <div class="form-group">
                        <label for="update-name">Nom :</label>
                        <input type="text" name="name" id="update-name" placeholder="Nom">
                    </div>
                    <div class="form-group">
                        <label for="update-phone">Numéro de téléphone :</label>
                        <input type="text" name="phone" id="update-phone" placeholder="Numéro de téléphone">
                    </div>
                    <div class="form-group">
                        <label for="update-password">Mot de passe :</label>
                        <input type="password" name="password" id="update-password" placeholder="Mot de passe">
                    </div>
                    <div class="form-group">
                        <label for="update-password-confirmation">Confirmer le mot de passe :</label>
                        <input type="password" name="password_confirmation" id="update-password-confirmation" placeholder="Confirmer le mot de passe">
                    </div>
                    <button class="button-modify" type="submit">Modifier le compte</button>
                </form>
            </div>

            <div id="delete-form" class="form-section">
                <h3>Supprimer un compte</h3>
                <div id="delete-options" class="user-list">
                    <!-- Liste des comptes pour la suppression -->
                </div>
                <form id="delete-form-action" method="POST">
                    @csrf
                    @method('DELETE') <!-- Ajout de la méthode DELETE pour la suppression -->
                    <input type="hidden" name="id" id="delete-id">
                    <button class="button-delete" type="submit">Supprimer ce compte</button>
                </form>
            </div>

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

        function hideAllForms() {
            const sections = document.querySelectorAll('.form-section');
            sections.forEach(section => section.classList.remove('active'));
        }

        function populateUserList(users) {
            const userList = document.getElementById('user-list');
            userList.innerHTML = ''; // Vider la liste existante

            const ul = document.createElement('ul');
            users.forEach(user => {
                const li = document.createElement('li');
                li.innerHTML = `${user.name} (${user.email})
                    <button onclick="selectUser('${user.id}', '${user.name}', '${user.phone}')">Sélectionner</button>`;
                ul.appendChild(li);
            });
            userList.appendChild(ul);
        }

        function populateDeleteOptions(users) {
            const deleteOptions = document.getElementById('delete-options');
            deleteOptions.innerHTML = ''; // Vider la liste existante

            const ul = document.createElement('ul');
            users.forEach(user => {
                const li = document.createElement('li');
                li.innerHTML = `${user.name} (${user.email})
                    <button onclick="confirmDelete('${user.id}')">Sélectionner</button>`;
                ul.appendChild(li);
            });
            deleteOptions.appendChild(ul);
        }

        function selectUser(id, name, phone) {
            document.getElementById('update-id').value = id;
            document.getElementById('update-name').value = name;
            document.getElementById('update-phone').value = phone;

            // Met à jour l'action du formulaire avec l'ID sélectionné
            const formAction = `{{ url('users') }}/${id}`;
            document.getElementById('modify-form-action').action = formAction;

            showForm('modify');
        }

        function confirmDelete(id) {
            document.getElementById('delete-id').value = id;

            // Met à jour l'action du formulaire avec l'ID sélectionné
            const formAction = `{{ url('users') }}/${id}`;
            document.getElementById('delete-form-action').action = formAction;

            showForm('delete');
        }

        function loadUserList() {
            fetch('{{ route('users.list') }}') // Remplacez par votre route Laravel
                .then(response => response.json())
                .then(data => populateUserList(data))
                .catch(error => console.error('Erreur lors du chargement des utilisateurs:', error));
        }

        function loadDeleteOptions() {
            fetch('{{ route('users.list') }}') // Remplacez par votre route Laravel
                .then(response => response.json())
                .then(data => populateDeleteOptions(data))
                .catch(error => console.error('Erreur lors du chargement des utilisateurs pour suppression:', error));
        }
    </script>
</body>
</html>
