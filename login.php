<?php
session_start();
require 'db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Include 'role' in your SELECT statement
    $stmt = $conn->prepare("SELECT id, email, password, role FROM auth WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role']; // Store the user's role in a session variable
            
            header('Location: form.php'); // Redirect to a protected page
            exit();
        }
    }
    header('Location: index.html'); // Redirect back to login on failure
    exit();
}