# INFO4345 WEB APP SECURITY | Class Assignment - Input Validation (Client & Server Side)

## Overview
This project showcases a comprehensive approach to web application security focusing on input validation from both client and server-side perspectives. It involves a web form designed to collect student details, employing HTML, CSS (Bootstrap for styling), JavaScript, and PHP. The emphasis is on secure input validation using regex functions across HTML, JavaScript, and PHP to ensure robust data integrity and prevent common web vulnerabilities.

## Components
- **form.html**: The primary interface where users input student details. Fields include student name, matriculation number, addresses, email, and phone numbers, with HTML's `pattern` attribute for regex-based validation.
- **validation.js**: Manages client-side validation, ensuring all input fields conform to expected formats before submission. Utilizes JavaScript's `test()` method for regex validation.
- **addData.php**: Processes form submissions server-side, performing additional validation checks before persisting data to a MySQL database. Leverages PHP's `preg_match()` for regex validation.
- **displayData.php**: Retrieves and displays stored student information from the database, presenting it in a dynamic HTML table format.

## File Interactions
- `form.html` employs `validation.js` for preliminary client-side validation. Upon validation, data is submitted to `addData.php` for further processing.
- `addData.php` validates, processes, and stores submitted data in the database.
- `displayData.php` accesses the database to fetch and display the submitted details, allowing users to view entered information post-submission.

## Navigating the Application
- Users start at `form.html`, entering student information and benefiting from real-time input validation.
- Upon form submission, if validations pass, `addData.php` stores the data and may redirect to `displayData.php`.
- `displayData.php` allows users to view all stored student details, demonstrating successful data storage and retrieval.

This project serves as a practical implementation of both client and server-side validation techniques, emphasizing the importance of secure data handling in web development.
