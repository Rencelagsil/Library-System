<?php
session_start();

$host = 'localhost';
$dbname = 'library management'; // your DB name
$username = 'root';             // your DB username
$password = '';                 // your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $user_password = $_POST['password'] ?? '';

    if ($student_id === '' || $user_password === '') {
        $error = "Please enter both Student ID and Password.";
    } else {
        // Get user info by student_id
        $stmt = $pdo->prepare("SELECT student_id, password, approval_status FROM students_registration WHERE student_id = :student_id LIMIT 1");
        $stmt->execute(['student_id' => $student_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user_password === $user['password']) { // Plain text password check (not recommended, better to hash)
            if ($user['approval_status'] === 'Approved') {
                // Approved: log in
                $_SESSION['student_id'] = $user['student_id'];
                header("Location: studentdashboard.php");
                exit;
            } else {
                // Not approved
                $error = "Opss! Your account still pending, Wait for the staff approvals.";
            }
        } else {
            $error = "Invalid Student ID or Password.";
        }
    }
}
?>

<?php if (!empty($error)) : ?>
    <script>alert('<?php echo addslashes($error); ?>');</script>
<?php endif; ?>
