<?php
require 'security_config.php';
startSecureSession();  

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Validate CSRF token first
    if (!validateCsrfToken($_POST['csrf_token'])) {
        die('CSRF token validation failed.');
    }

    require 'db.php'; 

    // Sanitize and validate the email and password input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT id, email, password, role FROM auth WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists and verify password
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            // Set session variables upon successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            header('Location: form.php'); // Redirect to form page on successful login
            exit;
        } else {
            $_SESSION['error'] = 'Invalid email or password.';
        }
    } else {
        $_SESSION['error'] = 'No user found with that email address.';
    }

    $stmt->close();
    $conn->close();

    header('Location: index.php'); // Redirect back to login page on failure
    exit;
}

// Include the login form or redirect if this script is accessed without POST
header('Location: index.php');
exit;
