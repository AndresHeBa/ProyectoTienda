function validatePassword() {
    // validad contraseñas
    const password = document.getElementById('password'); // Cambiar a 'password'
    const confirmPassword = document.getElementById('confirmPassword');
    const message = document.getElementById('mensaje');

    // Verificar coincidencia de contraseñas
    if (password.value == "" && confirmPassword.value == "") {
        message.innerHTML = "Las contraseñas no pueden estar vacias";
        message.style.color = 'red';
    } else if (password.value == confirmPassword.value) {
        message.innerHTML = "Las contraseñas coinciden";
        message.style.color = 'green';
    }
    else {
        message.innerHTML = "Las contraseñas no coinciden";
        message.style.color = 'red';
    }
}

function validatecorrectPassword() {
    // validad contraseñas
    const password = document.getElementById('password'); // Cambiar a 'password'
    const message2 = document.getElementById('mensaje2');

    // Criterios de contraseña segura
    const minLength = 8; // Mínimo de 8 caracteres
    const hasUpperCase = /[A-Z]/.test(password.value); // Al menos una letra mayúscula
    const hasLowerCase = /[a-z]/.test(password.value); // Al menos una letra minúscula
    const hasDigit = /\d/.test(password.value); // Al menos un número
    const hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password.value); // Al menos un carácter especial

    // Verificar cumplimiento de criterios
    if (password.value.length == 0) {
        message2.innerHTML = "La contraseña no puede estar vacia";
        message2.style.color = 'red';
    }
    else if (
        password.value.length >= minLength &&
        hasUpperCase &&
        hasLowerCase &&
        hasDigit &&
        hasSpecialChar
    ) {
        message2.innerHTML = "Contraseña segura";
        message2.style.color = 'green';
    } else {
        message2.innerHTML = "La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula, un número y un carácter especial.";
        message2.style.color = 'red';
    }
}