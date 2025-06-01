<?php
session_start();

// Ensure student is logged in
if (!isset($_SESSION['student_id'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Not logged in."]);
    exit;
}

$student_id = $_SESSION['student_id'];

$host = "localhost";
$dbname = "library management";
$username = "root";
$password = "";

// Get raw POST data
$data = json_decode(file_get_contents("php://input"), true);

// Extract only the ISBN now — student_id comes from the session
$isbn = $data['isbn'] ?? null;

if (!$isbn) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Missing ISBN."]);
    exit;
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validate student_id still exists in students_registration
    $checkStudent = $conn->prepare("SELECT 1 FROM students_registration WHERE student_id = ?");
    $checkStudent->execute([$student_id]);

    if ($checkStudent->rowCount() === 0) {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Student not found."]);
        exit;
    }

    // Insert borrowed book
    $stmt = $conn->prepare("INSERT INTO borrowed_books (student_id, isbn, borrow_date) VALUES (?, ?, NOW())");
    $stmt->execute([$student_id, $isbn]);

    echo json_encode(["status" => "success", "message" => "Book borrowed successfully."]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
?>
