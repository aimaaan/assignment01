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
        case 'delete':
            $stmt = $conn->prepare("DELETE FROM student_details WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            echo "<p>Deleted</p>";  
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
            echo "<p>Updated</p>";  
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
        echo '<td>' . htmlspecialchars($row["name"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["matric_no"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["current_address"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["home_address"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["email"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["mobile_phone"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["home_phone"]) . '</td>';
        echo "<td><button onclick='performAction(\"edit\", {$row['id']})'>Edit</button></td>";
        echo "<td><button onclick='performAction(\"delete\", {$row['id']})'>Delete</button></td>";
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="9">No data found</td></tr>';
}
echo '</tbody>';
echo '</table>';

$conn->close();

