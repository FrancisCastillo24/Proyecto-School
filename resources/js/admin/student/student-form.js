document.addEventListener('DOMContentLoaded', () => {
    const userSelect = document.getElementById('user_id');
    const newUserFields = document.getElementById('newUserFields');

    function toggleNewUserFields() {
        const inputs = newUserFields.querySelectorAll('input');
        if (userSelect.value !== "") {
            inputs.forEach(input => {
                input.disabled = true;
                input.required = false;
            });
        } else {
            inputs.forEach(input => {
                input.disabled = false;
                input.required = true;
            });
        }
    }

    userSelect.addEventListener('change', toggleNewUserFields);
    toggleNewUserFields(); // Inicial
});
