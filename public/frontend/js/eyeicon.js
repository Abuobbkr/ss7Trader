document.addEventListener('DOMContentLoaded', () => {
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    const togglePasswordVisibility = () => {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        togglePassword.classList.toggle('fa-eye-slash', !isPassword);
        togglePassword.classList.toggle('fa-eye', isPassword);
    };

    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', togglePasswordVisibility);
        
        // Optional: Add keyboard accessibility
        togglePassword.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                togglePasswordVisibility();
            }
        });
        
        // Set ARIA attributes for accessibility
        togglePassword.setAttribute('role', 'button');
        togglePassword.setAttribute('aria-label', 'Toggle password visibility');
        togglePassword.setAttribute('tabindex', '0');
    }
});