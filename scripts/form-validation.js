document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('form[action="scripts/auth.php"]');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            const email = loginForm.email.value;
            const password = loginForm.password.value;
            const role = loginForm.role.value;

            if (!email || !password || !role) {
                alert('Please fill in all fields.');
                event.preventDefault();
            }
        });
    }
});