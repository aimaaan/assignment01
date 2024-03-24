<?php
// Database configuration
$host = 'localhost'; // or your database host
$dbname = 'webapp_security';
$username = 'root';
$password = '';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select data from the table
$sql = "SELECT name, matric_no, current_address, home_address, email, mobile_phone, home_phone FROM students";
$result = $conn->query($sql);

// Start HTML output
echo '<table border="1">';
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

// Close connection
$conn->close();

