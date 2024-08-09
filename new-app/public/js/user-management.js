document.addEventListener('DOMContentLoaded', () => {
    loadUserList(); // Charger la liste des utilisateurs au chargement de la page
});

async function loadUserList() {
    try {
        const response = await fetch('/api/users');
        if (!response.ok) {
            throw new Error('Erreur lors du chargement des utilisateurs');
        }
        const data = await response.json();
        populateUserList(data);
    } catch (error) {
        console.error('Erreur lors du chargement des utilisateurs:', error);
    }
}

async function addUser() {
    const name = document.getElementById('add-name').value;
    const email = document.getElementById('add-email').value;
    const phone = document.getElementById('add-phone').value;
    const password = document.getElementById('add-password').value;
    const passwordConfirmation = document.getElementById('add-password-confirmation').value;

    try {
        const response = await fetch('/api/users', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name,
                email,
                phone,
                password,
                password_confirmation: passwordConfirmation
            }),
        });

        if (!response.ok) {
            throw new Error('Erreur lors de l\'ajout de l\'utilisateur');
        }
        const data = await response.json();
        console.log('Utilisateur ajouté:', data);
        loadUserList(); // Recharger la liste des utilisateurs après ajout
    } catch (error) {
        console.error('Erreur lors de l\'ajout de l\'utilisateur:', error);
    }
}

async function deleteUser(id) {
    try {
        const response = await fetch(`/api/users/${id}`, {
            method: 'DELETE',
        });

        if (!response.ok) {
            throw new Error('Erreur lors de la suppression de l\'utilisateur');
        }
        console.log('Utilisateur supprimé avec succes');
        loadUserList(); // Recharger la liste des utilisateurs après suppression
    } catch (error) {
        console.error('Erreur lors de la suppression de l\'utilisateur:', error);
    }
}

function populateUserList(users) {
    const userList = document.getElementById('user-list');
    userList.innerHTML = ''; // Vider la liste existante

    const ul = document.createElement('ul');
    users.forEach(user => {
        const li = document.createElement('li');
        li.innerHTML = `${user.name} (${user.email})
            <button class="select-button" onclick="selectUser('${user.id}', '${user.name}', '${user.phone}')">Sélectionner</button>`;
        ul.appendChild(li);
    });
    userList.appendChild(ul);
}

function selectUser(id, name, phone) {
    document.getElementById('update-id').value = id;
    document.getElementById('update-name').value = name;
    document.getElementById('update-phone').value = phone;
    showForm('modify');
}

function showForm(formType) {
    document.getElementById('form-add').style.display = formType === 'add' ? 'block' : 'none';
    document.getElementById('form-modify').style.display = formType === 'modify' ? 'block' : 'none';
    document.getElementById('form-delete').style.display = formType === 'delete' ? 'block' : 'none';
}
function confirmDelete(id) {
    console.log('ID à supprimer:', id); // Vérifiez que l'ID est bien celui attendu
    document.getElementById('delete-id').value = id;
    showForm('delete');
}
