document.addEventListener('DOMContentLoaded', function () {
    const userSelect = document.getElementById('user');
    const roleSelect = document.getElementById('role');
    const assignRoleBtn = document.getElementById('assignRoleBtn');

    function validateForm() {
        assignRoleBtn.disabled = !(userSelect.value && roleSelect.value);
    }

    userSelect.addEventListener('change', validateForm);
    roleSelect.addEventListener('change', validateForm);
});
