// /js/alerts.js

export function showSuccessAlert(message) {
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: message,
        timer: 3000, // El mensaje desaparecerá después de 3 segundos
        showConfirmButton: false
    });
}

export function showErrorAlert(message) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: message,
        timer: 3000,
        showConfirmButton: false
    });
}

export function showDeleteConfirmation(callback) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡Esta acción no puede deshacerse!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            callback();  // Llama a la función de confirmación de eliminación
        }
    });
}
