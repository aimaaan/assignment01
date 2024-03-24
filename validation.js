document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(event) {
        // Prevent form submission to check the validation
        event.preventDefault();
    
        let isValid = true;
    
        // Validation for Name
        const nameInput = document.getElementById('name');
        const namePattern = /^[A-Za-z\s]+$/; // Regex pattern for alphabets and spaces
        if (!namePattern.test(nameInput.value)) {
            alert('Please enter a valid name.');
            isValid = false;
        }

        // validation for matric no
        const matricInput = document.getElementById('matric-no');
        const matricPattern = /^\d{7}$/; // Regex pattern for 7 digits
        if (!matricPattern.test(matricInput.value)) {
            alert('Please enter a valid matric number.');
            isValid = false;
        }

        // Validation for current Address
        const currentAddressInput = document.getElementById('current-address');
        const currentAddressPattern = /^[A-Za-z0-9\s,.]+(?:\d{5})?.*/; // Regex pattern for alphabets, numbers and spaces
        if (!currentAddressPattern.test(currentAddressInput.value)) {
            alert('Please enter a valid current address.');
            isValid = false;
        }

        // Validation for home Address
        const homeAddressInput = document.getElementById('home-address');
        const homeAddressPattern = /^[A-Za-z0-9\s,.]+(?:\d{5})?.*/; // Regex pattern for alphabets, numbers and spaces
        if (!homeAddressPattern.test(homeAddressInput.value)) {
            alert('Please enter a valid home address.');
            isValid = false;
        }
        
        // Validation for Email
        const emailInput = document.getElementById('email');
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex pattern for email address
        if (!emailPattern.test(emailInput.value)) {
            alert('Please enter a valid email address.');
            isValid = false;
        }
            
        // Validation for Mobile Phone Number 
        const mobilePhoneInput = document.getElementById('mobile-phone');
        const mobilePhonePattern = /^[0-9].{10,}$/; // Regex pattern for 10 or more digits
        if (!mobilePhonePattern.test(mobilePhoneInput.value)) {
            alert('Please enter a valid mobile phone number with at least 10 digits.');
            isValid = false;
        }
    
        // Validation for Home Phone Number 
        const homePhoneInput = document.getElementById('home-phone');
        const homePhonePattern = /^[0-9].{10,}$/; // Regex pattern for 10 or more digits
        if (!homePhonePattern.test(homePhoneInput.value)) {
            alert('Please enter a valid home phone number with at least 10 digits.');
            isValid = false;
        }
    
        // If all inputs are valid, submit the form
        if (isValid) {
            form.submit();
            console.log('Form submitted');
        }
    });
});
