//validate the form before submitting it to the server side for further processing and storage in the database

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', 'login', function(event) {
        event.preventDefault();
    
        let isValid = true;
    
        // Validation for Name
        const nameInput = document.getElementById('name');
        const namePattern = /^[A-Za-z\s]+$/; 
        if (!namePattern.test(nameInput.value)) {
            alert('Please enter a valid name.');
            isValid = false;
        }

        // validation for matric no
        const matricInput = document.getElementById('matric-no');
        const matricPattern = /^\d{7}$/; 
        if (!matricPattern.test(matricInput.value)) {
            alert('Please enter a valid matric number.');
            isValid = false;
        }

        // Validation for current Address
        const currentAddressInput = document.getElementById('current-address');
        const currentAddressPattern = /^[A-Za-z0-9\s,.]+(?:\d{5})?.*/; 
        if (!currentAddressPattern.test(currentAddressInput.value)) {
            alert('Please enter a valid current address.');
            isValid = false;
        }

        // Validation for home Address
        const homeAddressInput = document.getElementById('home-address');
        const homeAddressPattern = /^[A-Za-z0-9\s,.]+(?:\d{5})?.*/; 
        if (!homeAddressPattern.test(homeAddressInput.value)) {
            alert('Please enter a valid home address.');
            isValid = false;
        }
        
        // Validation for Email
        const emailInput = document.getElementById('email');
        const emailPattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; 
        if (!emailPattern.test(emailInput.value)) {
            alert('Please enter a valid email address.');
            isValid = false;
        }
            
        // Validation for Mobile Phone Number 
        const mobilePhoneInput = document.getElementById('mobile-phone');
        const mobilePhonePattern = /^[0-9].{10,}$/; 
        if (!mobilePhonePattern.test(mobilePhoneInput.value)) {
            alert('Please enter a valid mobile phone number with at least 10 digits.');
            isValid = false;
        }
    
        // Validation for Home Phone Number 
        const homePhoneInput = document.getElementById('home-phone');
        const homePhonePattern = /^[0-9].{10,}$/; 
        if (!homePhonePattern.test(homePhoneInput.value)) {
            alert('Please enter a valid home phone number with at least 10 digits.');
            isValid = false;
        }
    
        if (isValid) {
            form.submit();
            console.log('Form submitted');
        }
    });
});



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
