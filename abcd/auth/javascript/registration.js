const validate_with_regex = (value, regex, empty_str, invalid_str) => {
    if (!value) return empty_str;
    if (!regex.test(value)) return invalid_str;
    return '';
};

const validate_username = (value) => {
    if (!value) return 'A username is required';
    if (value.length < 3 || value.length > 10) {
        return 'The username must be between 3 and 10 characters';
    }
    return '';
};

const validate_email = (value) =>
    validate_with_regex(value, /^[^\s@]+@[^\s@]+\.[^\s@]+$/, 'An email is required', 'Invalid email format');

const validate_password = (value) =>
    validate_with_regex(value, /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,10}$/, 'A password is required',
        'The password must be between 6–10 chars and it must contain upper case letters, lower case letters and digits');

const validate_confirm_password = (password, confirm) => {
    if (password !== confirm) return 'Passwords do not match';
    return '';
};


const validate_form_initial = ({ inputId, errorId, validator }) => {
    const input = document.getElementById(inputId);
    const error = document.getElementById(errorId);

    input.addEventListener('input', () => {
        const message = validator(input.value);
        error.textContent = message;
    });
};

const fields = [
    {
        inputId: 'username',
        errorId: 'username-error',
        validator: validate_username
    },
    {
        inputId: 'email',
        errorId: 'email-error',
        validator: validate_email
    },
    {
        inputId: 'password',
        errorId: 'password-error',
        validator: validate_password
    }
];

const validate_confirm_password_initial = () => {
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('confirm-password');
    const errorEl = document.getElementById('confirm-password-error');

    const validate = () => {
        if (confirmInput.value.length > 0) {
            const message = validate_confirm_password(
                passwordInput.value,
                confirmInput.value
            );
            errorEl.textContent = message;
        } else {
            errorEl.textContent = '';
        }
    };

    passwordInput.addEventListener('input', validate);
    confirmInput.addEventListener('input', validate);
};


const validate_form_initial_startup = () => {
    fields.forEach(validate_form_initial);
    validate_confirm_password_initial();
};

document.addEventListener('DOMContentLoaded', validate_form_initial_startup);

const validate_form_submit = () => {
    let is_valid = true;

    fields.forEach(({ inputId, errorId, validator }) => {
        const input = document.getElementById(inputId);
        const errorEl = document.getElementById(errorId);

        const message = validator(input.value);
        errorEl.textContent = message;

        if (message) {
            is_valid = false;
        }
    });

    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm-password').value;
    const confirmError = document.getElementById('confirm-password-error');

    const confirmMessage = validate_confirm_password(password, confirm);
    confirmError.textContent = confirmMessage;

    if (confirmMessage) is_valid = false;

    return is_valid;
};

const check_user_exists = async (username) => {
    const response = await fetch(
        `/abcd/auth/php/check_username.php?username=${encodeURIComponent(username)}`
    );

    if (!response.ok) {
        throw new Error('Failed to check username');
    }

    console.log("Checked for username");

    const data = await response.json();
    return data.exists;
};

const register_user = async (userData) => {
    const response = await fetch('https://jsonplaceholder.typicode.com/users', {
        method: 'POST',
        body: JSON.stringify(userData),
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        },
    });
    
    if (!response.ok) throw new Error('Registration failed');
    return await response.json();
};

const validate_submission = () => {
    const form = document.querySelector('form');
    const username_error = document.getElementById("username-error");

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (!validate_form_submit()) {
            console.log("Invalid submission");
            return;
        }

        const username_value = document.getElementById("username").value;

        try {
            const username_exists = await check_user_exists(username_value);

            if (username_exists) {
                username_error.textContent = 'This username is already taken';
                return;
            }

            form.submit();

        } catch (error) {
            console.error(error);
            username_error.textContent =
                'Could not verify username. Please try again.';
        }
    });
};

document.addEventListener('DOMContentLoaded', validate_submission);