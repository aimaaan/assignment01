<?php
session_start();
require 'db.php'; // Your database connection file

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Example using a placeholder for fetching user data
    $stmt = $conn->prepare("SELECT id, email, password FROM auth WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            
            header('Location: form.php'); // Redirect to a protected page
            exit();
        }
    }
    header('Location: index.html'); // Redirect back to login on failure
    exit();
}

