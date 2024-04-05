# INFO4345 WEB APP SECURITY | Class Assignment - Input Validation (Client & Server Side)

## Overview
This project is designed to illustrate a secure web application framework with an emphasis on both client and server-side input validation, along with implementing a robust authentication system. Utilizing HTML, CSS (Bootstrap for styling), JavaScript for client-side validation, and PHP for server-side logic, this assignment covers the fundamentals of secure web development practices.

## Components
- **form.html**: The primary interface where admin users input student details. Fields include student name, matriculation number, addresses, email, and phone numbers, with HTML's `pattern` attribute for regex-based validation.
- **validation.js**: Manages client-side validation, ensuring all input fields conform to expected formats before submission. Utilizes JavaScript's `test()` method for regex validation.
- **addData.php**: Processes form submissions server-side, performing additional validation checks before persisting data to a MySQL database. Leverages PHP's `preg_match()` for regex validation.
- **displayData.php**: Retrieves and displays stored student information from the database, presenting it in a dynamic HTML table format.
- **index.html**: The login page where existing users can sign in.
- **register.html**: The registration page for new users to create an account.
- **login.php**: Handles the authentication of users, including input validation and session management.
- **logout.php**: Facilitates user logout, terminating the session and redirecting to the login page.
- **register.php**: Processes new user registrations, including input validation and inserting new records into the database with `password_hash()` and `htmlspecialchars()`.
- **session_checks.php**: Ensures that certain pages are accessible only by authenticated users, redirecting unauthenticated requests to the login page.
- **function.js**: Contains functions for client-side validation of email and password fields.

## File Interactions
- `form.html` employs `validation.js` for preliminary client-side validation. Upon validation, data is submitted to `addData.php` for further processing.
- `addData.php` validates, processes, and stores submitted data in the database.
- `displayData.php` accesses the database to fetch and display the submitted details, allowing users to view entered information post-submission.

## Navigating the Application
- Users start at `form.html`, entering student information and benefiting from real-time input validation.
- Upon form submission, if validations pass, `addData.php` stores the data and may redirect to `displayData.php`.
- `displayData.php` allows users to view all stored student details, demonstrating successful data storage and retrieval.

This project serves as a practical implementation of both client and server-side validation techniques, emphasizing the importance of secure data handling in web development.
