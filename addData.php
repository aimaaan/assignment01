<?php
require 'session_checks.php';  
require 'security_config.php';  
startSecureSession();  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate CSRF token first
    if (!validateCsrfToken($_POST['csrf_token'])) {
        die('CSRF token validation failed.');
    }

    // Proceed with data processing since the CSRF token is valid
    require 'db.php'; 

    // Retrieve form data and prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $matric_no = $conn->real_escape_string($_POST['matric_no']);
    $current_address = $conn->real_escape_string($_POST['current_address']);
    $home_address = $conn->real_escape_string($_POST['home_address']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile_phone = $conn->real_escape_string($_POST['mobile_phone']);
    $home_phone = $conn->real_escape_string($_POST['home_phone']);

    // Validation checks for input fields
    if (!preg_match('/^[A-Za-z\s]+$/', $name) || 
        !preg_match('/^\d{7}$/', $matric_no) ||
        !preg_match('/^[A-Za-z0-9\s,.]+(?:\d{5})?.*/', $current_address) ||
        !preg_match('/^[A-Za-z0-9\s,.]+(?:\d{5})?.*/', $home_address) ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        !preg_match('/^[0-9].{10,}$/', $mobile_phone) ||
        !preg_match('/^[0-9].{10,}$/', $home_phone)) {
        echo "Input validation failed.";
        exit;
    }

    // Prepare SQL statement to insert form data into the database
    $stmt = $conn->prepare("INSERT INTO student_details (name, matric_no, current_address, home_address, email, mobile_phone, home_phone) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $matric_no, $current_address, $home_address, $email, $mobile_phone, $home_phone);

    if ($stmt->execute()) {
        header("Location: form.php");  // Redirect on successful insertion
    } else {
        echo "Error: " . $stmt->error;  // Display error message if insertion fails
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No data posted with HTTP POST.";  // Error message if no POST data is received
}

