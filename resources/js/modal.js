document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM completamente cargado y analizado');

    var updateStudentModal = document.getElementById('updateStudentModal');
    if (updateStudentModal) {
        console.log('Modal de actualización encontrado');
        updateStudentModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            if (!button) {
                console.error('No se encontró el botón que activó el modal.');
                return;
            }
            console.log('Botón que activó el modal:', button);

            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var email = button.getAttribute('data-email');
            var phone = button.getAttribute('data-phone');
            var language = button.getAttribute('data-language');

            console.log('Datos del estudiante:', { id, name, email, phone, language });

            var modal = this;
            modal.querySelector('#update-id').value = id;
            modal.querySelector('#update-name').value = name;
            modal.querySelector('#update-email').value = email;
            modal.querySelector('#update-phone').value = phone;
            modal.querySelector('#update-language').value = language;

            // Corregir la URL en el formulario
            var updateForm = document.getElementById('updateStudentForm');
            updateForm.setAttribute('action', '/students/' + id);
        });
    } else {
        console.error('No se encontró el modal de actualización de student');
    }
});
