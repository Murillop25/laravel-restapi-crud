import Swal from 'sweetalert2';

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

            // Añadir alerta al hacer clic en el botón de actualización
            var updateButton = modal.querySelector('#updateStudentBtn'); // Suponiendo que el botón tiene este id
            if (updateButton) {
                updateButton.addEventListener('click', function (event) {
                    event.preventDefault(); // Prevenir el envío inmediato

                    // Mostrar alerta de confirmación con SweetAlert2
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "¿Quieres actualizar la información del estudiante?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, actualizar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si el usuario confirma, se envía el formulario
                            updateForm.submit(); // Enviar el formulario de actualización
                        }
                    });
                });
            }
        });
    } else {
        console.error('No se encontró el modal de actualización');
    }

    // Manejar la eliminación de estudiantes
    document.querySelectorAll('.delete-student-btn').forEach(button => {
        button.addEventListener('click', function () {
            var studentId = this.getAttribute('data-id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Crear un formulario temporal para enviar la solicitud de eliminación
                    var form = document.createElement('form');
                    form.action = `/students/${studentId}`;
                    form.method = 'POST';
                    form.innerHTML = `
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="DELETE">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });
});
