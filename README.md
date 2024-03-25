INFO4345 WEB APP SECURITY | Class Assignment - Input Validation (Client & Server Side)

Overview
This project consists of a web form that collects student details, validates the input on the client-side, submits the data to the server, and then displays the submitted data dynamically on another page. 
The project utilizes HTML, CSS (with Bootstrap for styling), JavaScript for client-side validation, and PHP for server-side operations including form submission handling and data display.

Consists of:
- form.html:
This is the main page of the application where users can enter student details.
It includes fields for the student's name, matriculation number, current address, home address, email, mobile phone number, and home phone number.
The form uses Bootstrap for styling to make it visually appealing.

- validation.js:
This JavaScript file is responsible for client-side validation of the form inputs in form.html.
It checks that all inputs match their respective patterns (e.g., email format, phone number length) and alerts the user to any validation errors before the form is submitted.

- addData.php:
After the form submission, addData.php handles the server-side validation and processing of the submitted data. It inserts the data into a MySQL database if all validations pass.
This file ensures that the data stored in the database is consistent and formatted correctly.

- displayData.php:
This PHP script retrieves and displays all student details stored in the database. It generates a dynamic HTML table that lists every student's details.
This page is accessible after submitting the form, allowing users to see the stored information.

Relationships Between Files
- form.html uses validation.js to validate form inputs on the client side before submission.
- Upon submission, form.html sends data to addData.php for server-side processing and storage.
- displayData.php is then used to fetch and display the submitted data from the database in a tabular format.
- form.html may include a link to displayData.php or vice versa to navigate between submitting new data and viewing existing data.
