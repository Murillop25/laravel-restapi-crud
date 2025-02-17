// Esperar a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM completamente cargado y analizado');

    var editUserModal = document.getElementById('editUserModal');
    if (editUserModal) {
        console.log('Modal de edición de usuario encontrado');
        editUserModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            if (!button) {
                console.error('No se encontró el botón que activó el modal.');
                return;
            }
            console.log('Botón que activó el modal:', button);

            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var email = button.getAttribute('data-email');

            console.log('Datos del usuario:', { id, name, email });

            var modal = this;
            modal.querySelector('#edit-id').value = id;
            modal.querySelector('#edit-name').value = name;
            modal.querySelector('#edit-email').value = email;

            // Corregir la URL en el formulario
            var editForm = document.getElementById('editUserForm');
            editForm.setAttribute('action', '/users/' + id);
        });
    } else {
        console.error('No se encontró el modal de edición de usuario');
    }
});