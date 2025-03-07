document.addEventListener('DOMContentLoaded', function () {
    // ✅ Validar selección de usuario y rol
    const userSelect = document.getElementById('user');
    const roleSelect = document.getElementById('role');
    const assignRoleBtn = document.getElementById('assignRoleBtn');

    function validateForm() {
        assignRoleBtn.disabled = !(userSelect.value && roleSelect.value);
    }

    userSelect.addEventListener('change', validateForm);
    roleSelect.addEventListener('change', validateForm);

    // ✅ Funcionalidad para activar/inactivar usuarios
    const statusButtons = document.querySelectorAll('.toggle-status-btn');

    statusButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Evita el envío inmediato del formulario

            const form = button.closest('form');
            const userId = button.dataset.userId;
            const currentStatus = button.dataset.status; // 1 = Activo, 0 = Inactivo
            
            button.disabled = true; // Deshabilita el botón temporalmente

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cambia el estado visualmente sin recargar
                    button.dataset.status = currentStatus === '1' ? '0' : '1';
                    button.textContent = currentStatus === '1' ? 'Activar' : 'Desactivar';
                    button.style.backgroundColor = currentStatus === '1' ? 'grey' : 'green';

                    // Mostrar alerta con Notyf
                    showAlerts(data.message, []);

                } else {
                    showAlerts(null, [data.error || 'Hubo un error.']);
                }
            })
            .catch(() => {
                showAlerts(null, ['Error en la solicitud']);
            })
            .finally(() => {
                button.disabled = false; // Habilita el botón nuevamente
            });
        });
    });
});
