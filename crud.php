<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "Not authenticated";
    exit;
}

// Check and handle action requests
$action = $_POST['action'] ?? '';
$id = $_POST['id'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action && $id) {
    switch ($action) {
        case 'add':
            if ($_SESSION['role'] === 'admin') {
                // User is an admin, can add data
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
    
                $stmt = $conn->prepare("INSERT INTO student_details (name, matric_no, current_address, home_address, email, mobile_phone, home_phone) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssss", $name, $matric_no, $current_address, $home_address, $email, $mobile_phone, $home_phone);
    
                if ($stmt->execute()) {
                    header("Location: form.php");
                } else {
                    echo "Error: " . $stmt->error;
                }
    
                $stmt->close();
                $conn->close();
            } else {
                // User is not an admin, show an error message
                echo "You do not have permission to add this data.";
            }
            break;

        case 'delete':
            if ($_SESSION['role'] === 'admin') {
                // User is an admin, can delete any data
                $stmt = $conn->prepare("DELETE FROM student_details WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                echo "<p>Deleted</p>";
            } else {
                // User is not an admin, show an error message
                echo "You do not have permission to delete this data.";
            }
            break;

            case 'edit':
                if ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'user') {
                    // User is an admin or a user, can edit data
                    $name = $_POST['name'];
                    $matric_no = $_POST['matric_no'];
                    $current_address = $_POST['current_address'];
                    $home_address = $_POST['home_address'];
                    $email = $_POST['email'];
                    $mobile_phone = $_POST['mobile_phone'];
                    $home_phone = $_POST['home_phone'];
            
                    $stmt = $conn->prepare("UPDATE student_details SET name = ?, matric_no = ?, current_address = ?, home_address = ?, email = ?, mobile_phone = ?, home_phone = ? WHERE id = ?");
                    $stmt->bind_param("sssssssi", $name, $matric_no, $current_address, $home_address, $email, $mobile_phone, $home_phone, $id);
                    
                    if ($stmt->execute()) {
                        echo "<p>Record updated successfully</p>";
                    } else {
                        echo "<p>Error updating record: " . $stmt->error . "</p>";
                    }
                } else {
                    // User is not an admin or a user, show an error message
                    echo "You do not have permission to edit this data.";
                }
                break;
    }
}

// Pagination parameters
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// SQL query to select data
$sql = "SELECT id, name, matric_no, current_address, home_address, email, mobile_phone, home_phone FROM student_details LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

echo '<table class="table table-bordered">';
echo '<thead>';
echo '<tr>';
echo '<th>Name</th><th>Matric No</th><th>Current Address</th><th>Home Address</th><th>Email</th><th>Mobile Phone</th><th>Home Phone</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr id='row{$row['id']}'>";
        echo "<td><input type='text' id='name{$row['id']}' value='" . htmlspecialchars($row["name"]) . "'></td>";
        echo "<td><input type='text' id='matric_no{$row['id']}' value='" . htmlspecialchars($row["matric_no"]) . "'></td>";
        echo "<td><input type='text' id='current_address{$row['id']}' value='" . htmlspecialchars($row["current_address"]) . "'></td>";
        echo "<td><input type='text' id='home_address{$row['id']}' value='" . htmlspecialchars($row["home_address"]) . "'></td>";
        echo "<td><input type='text' id='email{$row['id']}' value='" . htmlspecialchars($row["email"]) . "'></td>";
        echo "<td><input type='text' id='mobile_phone{$row['id']}' value='" . htmlspecialchars($row["mobile_phone"]) . "'></td>";
        echo "<td><input type='text' id='home_phone{$row['id']}' value='" . htmlspecialchars($row["home_phone"]) . "'></td>";
        echo "<td><button onclick='performAction(\"edit\", {$row['id']})' data-id='{$row['id']}' data-action='edit'>Edit</button></td>";
        echo "<td><button onclick='performAction(\"delete\", {$row['id']})' data-id='{$row['id']}' data-action='delete'>Delete</button></td>";
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="9">No data found</td></tr>';
}
echo '</tbody>';
echo '</table>';

$conn->close();

