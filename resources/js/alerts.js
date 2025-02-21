import { Notyf } from 'notyf';
import 'notyf/notyf.min.css';

const notyf = new Notyf({
    position: {
        x: 'right',
        y: 'top',
    },
    duration: 5000, // Duración de la alerta en milisegundos
    dismissible: true // Permitir que las alertas se puedan cerrar manualmente
});

window.showAlerts = function(successMessage, errorMessages) {
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
};