document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.getElementById('submit-btn');
    const requiredInputs = document.querySelectorAll('#game-add-form input[required], #game-add-form textarea[required]');

    function checkForm() {
        let allFilled = true;
        requiredInputs.forEach(function(input) {
            if (!input.value.trim()) {
                allFilled = false;
            }
        });
        submitBtn.disabled = !allFilled;
    }

    requiredInputs.forEach(function(input) {
        input.addEventListener('keyup', checkForm);
        input.addEventListener('change', checkForm);
    });

    checkForm(); 
});