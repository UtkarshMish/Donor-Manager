<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name="snp_temp";
// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_select_db($conn,"$db_name")or die("cannot select DB");
?>