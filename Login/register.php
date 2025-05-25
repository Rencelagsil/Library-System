<?php

$host = "localhost";
$dbname = "library management";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $conn->real_escape_string($_POST['email']);
$studentId = $conn->real_escape_string($_POST['studentId']);
$usernameInput = $conn->real_escape_string($_POST['username']);
$pass = $_POST['password'];
$confirmPass = $_POST['confirmPassword'];


if ($pass !== $confirmPass) {
    echo "<script>alert('Passwords do not match.'); window.location.href = 'student_registration.php';</script>";
    exit;
}

$sql = "INSERT INTO students_registration (email, student_id, username, password)
        VALUES ('$email', '$studentId', '$usernameInput', '$pass')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Registration successful! Click OK to login.');
            window.location.href = 'signin.php';
          </script>";
} else {
    echo "<script>alert('Error: " . $conn->error . "');</script>";
}

$conn->close();
?>
