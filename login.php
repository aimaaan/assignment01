<?php
require 'security_config.php';
startSecureSession();
require 'db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    
    $stmt = $conn->prepare("SELECT id, email, password, role FROM auth WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role']; // Store the user's role in a session variable
            
            header('Location: form.php'); 
            exit();
        }
    }
    header('Location: index.html'); // Redirect back to login on failure
    exit();
}