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
