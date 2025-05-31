<?php
$host = "localhost";
$user = "root"; // or your DB username
$pass = "";     // or your DB password
$dbname = "library management";

// Connect to the database
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values
$title = $_POST['title'];
$author = $_POST['author'];
$isbn = $_POST['isbn'];
$publisher = $_POST['publisher'];
$year = $_POST['year'];
$category = $_POST['category'];
$copies = $_POST['copies'];
$shelf = $_POST['shelf'];

// Handle file upload (optional)
$cover = null;
if (isset($_FILES['cover']) && $_FILES['cover']['error'] == 0) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = basename($_FILES["cover"]["name"]);
    $targetFilePath = $targetDir . time() . "_" . $fileName;

    if (move_uploaded_file($_FILES["cover"]["tmp_name"], $targetFilePath)) {
        $cover = $targetFilePath;
    }
}

// Insert into database
$sql = "INSERT INTO books (title, author, isbn, publisher, publication_year, category, copies, shelf, cover_image)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssiss", $title, $author, $isbn, $publisher, $year, $category, $copies, $shelf, $cover);

if ($stmt->execute()) {
    echo "<script>alert('Book added successfully!'); window.location.href='add_book.html';</script>";
} else {
    echo "<script>alert('Error: " . addslashes($stmt->error) . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
