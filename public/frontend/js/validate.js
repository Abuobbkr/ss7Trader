document.addEventListener('DOMContentLoaded', function () {
    const newsletterForm = document.getElementById('newsletterForm');
    const emailInput = document.getElementById('newsletterEmail');
    const successMessage = document.getElementById('successMessage');

    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Reset previous states
            resetValidation();

            // Validate email
            const isValid = validateEmail();

            if (isValid) {
                // Form is valid - show success message
                successMessage.classList.remove('d-none');
                successMessage.classList.add('d-block');

                // Reset form after 3 seconds
                setTimeout(function () {
                    successMessage.classList.remove('d-block');
                    successMessage.classList.add('d-none');
                    newsletterForm.reset();
                    emailInput.classList.remove('is-valid');
                }, 3000);
            }
        });
    }

    function validateEmail() {
        const email = emailInput.value.trim();
        let isValid = true;

        // Check if empty
        if (email === '') {
            showError(emailInput, 'Email is required');
            isValid = false;
        }
        // Check if valid email format
        else if (!isValidEmail(email)) {
            showError(emailInput, 'Please enter a valid email address');
            isValid = false;
        } else {
            // Valid email
            emailInput.classList.add('is-valid');
        }

        return isValid;
    }

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function showError(input, message) {
        input.classList.add('is-invalid');

        // Remove existing error if any
        const existingError = input.nextElementSibling;
        if (existingError && existingError.classList.contains('invalid-feedback')) {
            existingError.remove();
        }

        // Create error element
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback';
        errorDiv.textContent = message;
        input.parentNode.insertBefore(errorDiv, input.nextSibling);
    }

    function resetValidation() {
        // Remove all error messages
        const errorMessages = newsletterForm.querySelectorAll('.invalid-feedback');
        errorMessages.forEach(msg => msg.remove());

        // Reset input classes
        emailInput.classList.remove('is-invalid', 'is-valid');
    }
});