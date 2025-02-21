import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';
import Swal from 'sweetalert2';

const notyf = new Notyf({
    position: {
        x: 'right',
        y: 'top',
    },
    duration: 5000, // Duración de la alerta en milisegundos
    dismissible: true // Permitir que las alertas se puedan cerrar manualmente
});

window.showAlerts = function(successMessage, errorMessages, warningMessage) {
    if (successMessage) {
        notyf.success(successMessage);
    }

    if (errorMessages && errorMessages.length > 0) {
        errorMessages.forEach(error => {
            let errorMessage = error;

            if (error.includes('password')) {
                errorMessage = 'Contraseña errónea';
            } else if (error.includes('email')) {
                errorMessage = 'Correo no registrado';
            }

            notyf.error(errorMessage);
        });
    }

    if (warningMessage) {
        notyf.warning(warningMessage);
    }
};

window.confirmDelete = function(event) {
    event.preventDefault();
    const form = event.target;

    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar!',
        cancelButtonText: 'No, cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
};

