<?php
$host = "localhost";
$user = "root";
$password = "";  // your db password
$dbname = "library management"; // your db name

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
