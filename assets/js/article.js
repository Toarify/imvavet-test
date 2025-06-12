document.addEventListener('DOMContentLoaded', () => {
    // Injection du timestamp client dans le champ caché
    const timestampField = document.querySelector('.client-timestamp-field');
    if (timestampField) {
        timestampField.value = Date.now();
    }
    
    // Mise à jour automatique lors de l'édition
    const editForm = document.querySelector('form[name="ea_edit_form"]');
    if (editForm) {
        editForm.addEventListener('submit', () => {
            const hiddenField = editForm.querySelector('.client-timestamp-field');
            if (hiddenField) {
                hiddenField.value = Date.now();
            }
        });
    }
});