// js for the login page

function validateForm() {
    const email = document.getElementById('email').value;
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!re.test(email.toLowerCase())) {
        alert("Please enter a valid email address.");
        return false;
    }
    return true;
}

function validatePassword() {
    var passwordInput = document.getElementById('password');
    var password = passwordInput.value;
    var errors = [];
    
    // Check the length of the password
    if (password.length < 8) {
        errors.push("Your password must be at least 8 characters."); 
    }
    // Check for an uppercase letter
    if (!password.match(/[A-Z]/)) {
        errors.push("Your password must include at least one uppercase letter."); 
    }
    // Check for a lowercase letter
    if (!password.match(/[a-z]/)) {
        errors.push("Your password must include at least one lowercase letter."); 
    }
    // Check for a number
    if (!password.match(/\d/)) {
        errors.push("Your password must contain at least one number."); 
    }
    // Check for a special character
    if (!password.match(/[\!\@\#\$\%\^\&\*]/)) {
        errors.push("Your password must contain at least one special character (!,@,#,$,%,^,&, or *)."); 
    }

    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }
    return true;
}

function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var toggle = document.getElementById('togglePassword');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggle.textContent = '🙈';
    } else {
        passwordInput.type = 'password';
        toggle.textContent = '👁️';
    }
}