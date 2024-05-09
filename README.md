# INFO4345 WEB APP SECURITY | Class Assignment - Input Validation (Client & Server Side)

## Overview
This project is designed to illustrate a secure web application framework with an emphasis on both client and server-side input validation, along with implementing a robust authentication system. Utilizing HTML, CSS (Bootstrap for styling), JavaScript for client-side validation, and PHP for server-side logic, this assignment covers the fundamentals of secure web development practices.

## Features
- **Registration System (`register.html` and `register.php`)**: Allows new users to create accounts, with input validation enforced on both client and server sides.
- **Login System (`index.html` and `login.php`)**: Authenticates users, granting access to the student detail form and submitted data display. Includes client-side and server-side validation for security.
- **Session Management (`session_checks.php`)**: Ensures that users can access certain pages only when logged in, redirecting unauthenticated users to the login page.
- **Student Detail Form (`form.html`)**: Collects student information, utilizing client-side validation for immediate feedback and server-side validation upon submission.
- **Data Display (`crud.php`)**: Shows submitted student details, demonstrating secure data storage and retrieval practices.
- **Role-Based Access Control**: Differentiates user capabilities based on their roles. Admin users have full access to all features, while user roles can only edit.
- **Content Security Policy (CSP)**: Implemented in `security_config.php`, it restricts resources the client loads, enhancing protection against XSS attacks by specifying trusted sources.
- **XSS Defense**: Inputs are sanitized to prevent execution of malicious scripts by using regex implementation on client-side and server-side.
- **CSRF Protection**: CSRF tokens are generated and validated for each session to prevent unauthorized actions. Implemented in `security_config.php` & are called at each of the file that using post request.

## Components
- **form.html**: The primary interface where admin users input student details. Fields include student name, matriculation number, addresses, email, and phone numbers, with HTML's `pattern` attribute for regex-based validation.
- **validation.js**: Manages client-side validation, ensuring all input fields conform to expected formats before submission. Utilizes JavaScript's `test()` method for regex validation.
- **addData.php**: Processes form submissions server-side, performing additional validation checks before persisting data to a MySQL database. Leverages PHP's `preg_match()` for regex validation.
- **index.html**: The login page where existing users can sign in.
- **register.html**: The registration page for new users to create an account.
- **login.php**: Handles the authentication of users, including input validation and session management.
- **logout.php**: Facilitates user logout, terminating the session and redirecting to the login page.
- **register.php**: Processes new user registrations, including input validation and inserting new records into the database with `password_hash()` and `htmlspecialchars()`.
- **session_checks.php**: Ensures that certain pages are accessible only by authenticated users, redirecting unauthenticated requests to the login page.
- **function.js**: Contains functions for client-side validation of email and password fields.
- **crud.php**: Retrieves and displays stored student information from the database, presenting it in a dynamic HTML table format, Handles server-side logic for creating, reading, updating, and deleting student records. Implements role-based access control to differentiate user capabilities.
- **security_config.php**: Centralizes security configurations including CSP implementation, CSRF token generation, and session security settings.

## File Interactions
- **Initial Setup**: Users start at `index.html` or `register.html` to log in or register.
- **Secure Session Management**: Integrated on all pages requiring secure interactions to initiate sessions with CSP and CSRF protection.
- **Form Submission**: Users submit details through `form.html`, processed by `addData.php` under stringent security checks.
- **Data Management**: `crud.php` retrieves and displays data, managing CRUD operations securely based on user roles.

## Navigating the Application
- Start by either logging in through `index.html` or registering a new account via `register.html`.
- Once authenticated, based on the role given by the admin. fill out the student detail form available at `form.html`.
- After submission, navigate to `displayData.php` to view the stored student information.
- Use the logout functionality to end the session securely when finished.
