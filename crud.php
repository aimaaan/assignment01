<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Not authenticated";
    exit;
}

$action = $_POST['action'] ?? '';
$id = $_POST['id'] ?? 0;

switch ($action) {
    case 'delete':
        $stmt = $conn->prepare("DELETE FROM student_details WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "Deleted";
        break;

    case 'edit':
        $name = $_POST['name'];
        $matric_no = $_POST['matric_no'];
        $current_address = $_POST['current_address'];
        $home_address = $_POST['home_address'];
        $email = $_POST['email'];
        $mobile_phone = $_POST['mobile_phone'];
        $home_phone = $_POST['home_phone'];
        
        $stmt = $conn->prepare("UPDATE student_details SET name = ?, matric_no = ?, current_address = ?, home_address = ?, email = ?, mobile_phone = ?, home_phone = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $name, $matric_no, $current_address, $home_address, $email, $mobile_phone, $home_phone, $id);
        $stmt->execute();
        echo "Updated";
        break;

    default:
        echo "Invalid action";
}
