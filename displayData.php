<?php
$host = 'localhost'; 
$dbname = 'webapp_security';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination parameters
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$offset = ($page - 1) * $limit; // Calculate the offset

// SQL query to select data from the table with limit and offset
$sql = "SELECT name, matric_no, current_address, home_address, email, mobile_phone, home_phone FROM student_details LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Start HTML output
echo '<table class="table table-bordered">';
echo '<tr><th>Name</th><th>Matric No</th><th>Current Address</th><th>Home Address</th><th>Email</th><th>Mobile Phone</th><th>Home Phone</th></tr>';

// Output data of each row
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'.htmlspecialchars($row["name"]).'</td>';
        echo '<td>'.htmlspecialchars($row["matric_no"]).'</td>';
        echo '<td>'.htmlspecialchars($row["current_address"]).'</td>';
        echo '<td>'.htmlspecialchars($row["home_address"]).'</td>';
        echo '<td>'.htmlspecialchars($row["email"]).'</td>';
        echo '<td>'.htmlspecialchars($row["mobile_phone"]).'</td>';
        echo '<td>'.htmlspecialchars($row["home_phone"]).'</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="7">No data found</td></tr>';
}

echo '</table>';

$conn->close();
