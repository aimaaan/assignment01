<?php
session_start(); 
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Retrieve form data and prevent SQL injection
    $name = $conn->real_escape_string($_POST['name']);
    $matric_no = $conn->real_escape_string($_POST['matric_no']);
    $current_address = $conn->real_escape_string($_POST['current_address']);
    $home_address = $conn->real_escape_string($_POST['home_address']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile_phone = $conn->real_escape_string($_POST['mobile_phone']);
    $home_phone = $conn->real_escape_string($_POST['home_phone']);

    if (!preg_match('/^[A-Za-z\s]+$/', $name)) {
        echo "Invalid name format";
        exit;
    }

    if (!preg_match('/^\d{7}$/', $matric_no)) {
        echo "Invalid matriculation number format";
        exit;
    }

    if (!preg_match('/^[A-Za-z0-9\s,.]+(?:\d{5})?.*/', $current_address)) {
        echo "Invalid current address format";
        exit;
    }

    if (!preg_match('/^[A-Za-z0-9\s,.]+(?:\d{5})?.*/', $home_address)) {
        echo "Invalid home address format";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    if (!preg_match('/^[0-9].{10,}$/', $mobile_phone)) {
        echo "Invalid mobile phone format";
        exit;
    }

    if (!preg_match('/^[0-9].{10,}$/', $home_phone)) {
        echo "Invalid home phone format";
        exit;
    }

    // Prepare SQL statement to insert form data into the database
    $stmt = $conn->prepare("INSERT INTO student_details (name, matric_no, current_address, home_address, email, mobile_phone, home_phone) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $matric_no, $current_address, $home_address, $email, $mobile_phone, $home_phone);

    // Execute the prepared statement
    if ($stmt->execute()) {
        header("Location: form.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "No data posted with HTTP POST.";
}
