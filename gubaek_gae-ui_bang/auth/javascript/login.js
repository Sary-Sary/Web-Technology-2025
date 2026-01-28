document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const errorEl = document.getElementById('login-error');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const login = document.getElementById('login').value;
        const password = document.getElementById('password').value;

        try {
            const response = await fetch('php/login_handler.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `login=${encodeURIComponent(login)}&password=${encodeURIComponent(password)}`
            });

            const data = await response.json();

            if (data.success) {
                window.location.href = '../test.php';
            } else {
                errorEl.textContent = data.message;
            }

        } catch (err) {
            console.error(err);
            errorEl.textContent = 'Server error. Try again later.';
        }
    });
});
