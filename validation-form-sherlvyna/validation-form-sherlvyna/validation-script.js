const form = document.getElementById('registrationForm');

form.addEventListener('submit', function(event) {
    event.preventDefault();
    let valid = true;

    document.querySelectorAll('.error').forEach(e => e.textContent = '');
    document.querySelectorAll('input, select').forEach(el => el.classList.remove('invalid'));

    const fullName = document.getElementById('fullName');
    if (fullName.value.trim() === '') {
    valid = false;
    showError(fullName, 'nameError', 'Full name cannot be empty.');
    }

    const email = document.getElementById('email');
    const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
    if (!emailPattern.test(email.value.trim())) {
    valid = false;
    showError(email, 'emailError', 'Enter a valid email address.');
    }

    const password = document.getElementById('password');
    if (password.value.length < 6) {
    valid = false;
    showError(password, 'passwordError', 'Password must be at least 6 characters.');
    }

    const confirmPassword = document.getElementById('confirmPassword');
    if (confirmPassword.value !== password.value || confirmPassword.value === '') {
    valid = false;
    showError(confirmPassword, 'confirmError', 'Passwords do not match.');
    }

    const phone = document.getElementById('phone');
    const phonePattern = /^[0-9]{10,}$/;
    if (!phonePattern.test(phone.value.trim())) {
    valid = false;
    showError(phone, 'phoneError', 'Phone must be numeric and at least 10 digits.');
    }

    const genderSelected = document.querySelector('input[name="gender"]:checked');
    if (!genderSelected) {
    valid = false;
    document.getElementById('genderError').textContent = 'Please select a gender.';
    }

    const hobbies = document.querySelectorAll('input[name="hobby"]:checked');
    if (hobbies.length === 0) {
    valid = false;
    document.getElementById('hobbyError').textContent = 'Select at least one hobby.';
    }

    const country = document.getElementById('country');
    if (country.value === '') {
    valid = false;
    showError(country, 'countryError', 'Please select a country.');
    }

    if (valid) {
    alert('Form submitted successfully!');
    form.reset();
    }
});

function showError(inputElement, errorId, message) {
    document.getElementById(errorId).textContent = message;
    inputElement.classList.add('invalid');
}