<?php
// api/borrow_book.php
$host = "localhost";
$dbname = "library management";
$username = "root";
$password = "";

// Get raw POST data
$data = json_decode(file_get_contents("php://input"), true);

// Extract data
$student_id = $data['student_id'] ?? null;
$isbn = $data['isbn'] ?? null;

if (!$student_id || !$isbn) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Missing student ID or ISBN."]);
    exit;
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validate student_id exists in student_registration table
    $checkStudent = $conn->prepare("SELECT 1 FROM student_registration WHERE student_id = ?");
    $checkStudent->execute([$student_id]);

    if ($checkStudent->rowCount() === 0) {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Student ID not found."]);
        exit;
    }

    // Insert borrowed book record with current date/time
    $stmt = $conn->prepare("INSERT INTO borrow_books (student_id, isbn, borrow_date) VALUES (?, ?, NOW())");
    $stmt->execute([$student_id, $isbn]);

    echo json_encode(["status" => "success", "message" => "Book borrowed successfully."]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
}
