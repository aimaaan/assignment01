# INFO4345 WEB APP SECURITY | Class Assignment - Input Validation (Client & Server Side)

## Overview
This project is designed to illustrate a secure web application framework with an emphasis on both client and server-side input validation, along with implementing a robust authentication system. Utilizing HTML, CSS (Bootstrap for styling), JavaScript for client-side validation, and PHP for server-side logic, this assignment covers the fundamentals of secure web development practices.

## Features
- **Registration System (`register.html` and `register.php`)**: Allows new users to create accounts, with input validation enforced on both client and server sides.
- **Login System (`index.html` and `login.php`)**: Authenticates users, granting access to the student detail form and submitted data display. Includes client-side and server-side validation for security.
- **Session Management (`session_checks.php`)**: Ensures that users can access certain pages only when logged in, redirecting unauthenticated users to the login page.
- **Student Detail Form (`form.html`)**: Collects student information, utilizing client-side validation for immediate feedback and server-side validation upon submission.
- **Data Display (`displayData.php`)**: Shows submitted student details, demonstrating secure data storage and retrieval practices.

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
- Users begin at `index.html` or `register.html` to log in or create a new account, respectively.
- Upon successful authentication, users are directed to `form.html` to enter and submit student details.
- `addData.php` processes and validates submitted information, storing it securely in the database.
- `displayData.php` fetches and displays all submitted student details, allowing users to review entered data.
- `session_checks.php` is included in all protected pages to manage access based on user authentication status.

## Navigating the Application
- Start by either logging in through `index.html` or registering a new account via `register.html`.
- Once authenticated, fill out the student detail form available at `form.html`.
- After submission, navigate to `displayData.php` to view the stored student information.
- Use the logout functionality to end the session securely when finished.
