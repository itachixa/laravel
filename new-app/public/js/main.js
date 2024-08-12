document.addEventListener('DOMContentLoaded', function() {
    let selectedButton = null;

    async function showForm(formId) {
        // Masquer toutes les sections
        const sections = document.querySelectorAll('.form-section');
        sections.forEach(section => section.classList.remove('active'));

        // Afficher la section sélectionnée
        const selectedSection = document.getElementById(`${formId}-form`);
        if (selectedSection) {
            selectedSection.classList.add('active');

            // Charger les données pour les sections appropriées
            if (formId === 'list') {
                await loadUserList();
            } else if (formId === 'delete') {
                await loadDeleteOptions();
            }
        }
    }

    async function submitForm(formId) {
        const form = document.getElementById(formId);
        if (!form) {
            console.error('Formulaire non trouvé:', formId);
            return;
        }

        const method = formId === 'delete-form' ? 'DELETE' : formId === 'modify-form' ? 'PUT' : 'POST';
        const url = formId === 'modify-form' ? getUpdateUrl() : formId === 'delete-form' ? getDeleteUrl() : form.action;
        const formData = new FormData(form);

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: method === 'DELETE' ? null : formData
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || 'Opération réussie!');
                if (formId === 'list-form') {
                    await loadUserList();
                }
                if (selectedButton) {
                    selectedButton.classList.remove('button-selected');
                    selectedButton = null;
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
            const response = await fetch('/users');
            const data = await response.json();
            const userList = document.getElementById('user-list');

            if (userList) {
                userList.innerHTML = data.map(user => `
                    <div>
                        ${user.id}: ${user.name} (${user.email})
                        <button onclick="selectUser('${user.id}', '${user.name}', '${user.email}', this)">Sélectionner</button>
                    </div>
                `).join('');
            } else {
                console.error('L\'élément user-list est introuvable.');
            }
        } catch (error) {
            console.error('Erreur lors du chargement des utilisateurs:', error);
        }
    }

    function selectUser(id, name, email, button) {
        if (selectedButton) {
            selectedButton.classList.remove('button-selected');
        }
        
        button.classList.add('button-selected');
        selectedButton = button;

        document.getElementById('delete-id').value = id;
        document.getElementById('delete-name').textContent = `${name} (${email})`;
        document.getElementById('update-id').value = id;
        document.getElementById('update-name').value = name;
        document.getElementById('update-phone').value = email;
        showForm('modify');
    }

    async function loadDeleteOptions() {
        try {
            const response = await fetch('/users');
            const data = await response.json();
            const deleteOptions = document.getElementById('delete-options');
            
            if (deleteOptions) {
                deleteOptions.innerHTML = data.map(user => `
                    <div>
                        ${user.id}: ${user.name} (${user.email})
                        <button onclick="confirmDelete('${user.id}', this)">Sélectionner</button>
                    </div>
                `).join('');
            } else {
                console.error('L\'élément delete-options est introuvable.');
            }
        } catch (error) {
            console.error('Erreur lors du chargement des utilisateurs pour suppression:', error);
        }
    }

    function confirmDelete(id, button) {
        document.getElementById('delete-id').value = id;
        if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')) {
            submitForm('delete-form');
        }
        if (button) {
            button.classList.remove('button-selected');
        }
    }

    function getUpdateUrl() {
        const id = document.getElementById('update-id').value;
        return `/users/${id}`;
    }

    function getDeleteUrl() {
        const id = document.getElementById('delete-id').value;
        return `/users/${id}`;
    }

    window.showForm = showForm;
    window.submitForm = submitForm;
    window.selectUser = selectUser;
document.addEventListener('DOMContentLoaded', function() {
    let selectedButton = null;

    async function showForm(formId) {
        // Masquer toutes les sections
        const sections = document.querySelectorAll('.form-section');
        sections.forEach(section => section.classList.remove('active'));

        // Afficher la section sélectionnée
        const selectedSection = document.getElementById(`${formId}-form`);
        if (selectedSection) {
            selectedSection.classList.add('active');

            // Charger les données pour les sections appropriées
            if (formId === 'list') {
                await loadUserList();
            } else if (formId === 'delete') {
                await loadDeleteOptions();
            }
        }
    }

    async function submitForm(formId) {
        const form = document.getElementById(formId);
        if (!form) {
            console.error('Formulaire non trouvé:', formId);
            return;
        }

        const method = formId === 'delete-form' ? 'DELETE' : formId === 'modify-form' ? 'PUT' : 'POST';
        const url = formId === 'modify-form' ? getUpdateUrl() : formId === 'delete-form' ? getDeleteUrl() : form.action;
        const formData = new FormData(form);

        try {
            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: method === 'DELETE' ? null : formData
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message || 'Opération réussie!');
                if (formId === 'list-form') {
                    await loadUserList();
                }
                if (selectedButton) {
                    selectedButton.classList.remove('button-selected');
                    selectedButton = null;
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
            const response = await fetch('/users');
            const data = await response.json();
            const userList = document.getElementById('user-list');

            if (userList) {
                userList.innerHTML = data.map(user => `
                    <div>
                        ${user.id}: ${user.name} (${user.email})
                        <button onclick="selectUser('${user.id}', '${user.name}', '${user.email}', this)">Sélectionner</button>
                    </div>
                `).join('');
            } else {
                console.error('L\'élément user-list est introuvable.');
            }
        } catch (error) {
            console.error('Erreur lors du chargement des utilisateurs:', error);
        }
    }

    function selectUser(id, name, email, button) {
        if (selectedButton) {
            selectedButton.classList.remove('button-selected');
        }
        
        button.classList.add('button-selected');
        selectedButton = button;

        document.getElementById('delete-id').value = id;
        document.getElementById('delete-name').textContent = `${name} (${email})`;
        document.getElementById('update-id').value = id;
        document.getElementById('update-name').value = name;
        document.getElementById('update-email').value = email;
        showForm('modify');
    }

    async function loadDeleteOptions() {
        try {
            const response = await fetch('/users');
            const data = await response.json();
            const deleteOptions = document.getElementById('delete-options');
            
            if (deleteOptions) {
                deleteOptions.innerHTML = data.map(user => `
                    <div>
                        ${user.id}: ${user.name} (${user.email})
                        <button onclick="confirmDelete('${user.id}', this)">Sélectionner</button>
                    </div>
                `).join('');
            } else {
                console.error('L\'élément delete-options est introuvable.');
            }
        } catch (error) {
            console.error('Erreur lors du chargement des utilisateurs pour suppression:', error);
        }
    }

    function confirmDelete(id, button) {
        document.getElementById('delete-id').value = id;
        if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?')) {
            submitForm('delete-form');
        }
        if (button) {
            button.classList.remove('button-selected');
        }
    }

    function getUpdateUrl() {
        const id = document.getElementById('update-id').value;
        return `/users/${id}`;
    }

    function getDeleteUrl() {
        const id = document.getElementById('delete-id').value;
        return `/users/${id}`;
    }

    window.showForm = showForm;
    window.submitForm = submitForm;
    window.selectUser = selectUser;
    window.confirmDelete = confirmDelete;
});
});