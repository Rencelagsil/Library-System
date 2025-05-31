<?php
$host = "localhost";
$dbname = "library management";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle approval or rejection actions
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $action = $_GET['action'];

    if ($action === 'approve') {
        $status = 'Approved';
    } elseif ($action === 'reject') {
        $status = 'Rejected';
    } else {
        $status = null;
    }

    if ($status) {
        $stmt = $conn->prepare("UPDATE students_registration SET approval_status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: approval.php");
    exit;
}

// Fetch pending students
$result = $conn->query("SELECT id, email, student_id, username FROM students_registration WHERE approval_status = 'Pending'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Student Approval</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9fafb;
        margin: 2rem;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    h2 {
        text-align: center;
        color: #1e40af;
        margin-bottom: 1.5rem;
        font-weight: 700;
        font-size: 1.8rem;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    thead {
        background-color: #1e40af;
        color: white;
    }

    th, td {
        padding: 0.8rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
    }

    tbody tr:hover {
        background-color: #f3f4f6;
    }

    .actions a {
        padding: 6px 14px;
        margin-right: 10px;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: background-color 0.3s ease;
        color: white;
        display: inline-block;
        user-select: none;
    }

    .approve {
        background-color: #16a34a; /* green */
    }

    .approve:hover {
        background-color: #15803d;
    }

    .reject {
        background-color: #dc2626; /* red */
    }

    .reject:hover {
        background-color: #b91c1c;
    }

    p.no-data {
        text-align: center;
        font-size: 1rem;
        color: #6b7280;
        margin-top: 2rem;
        font-weight: 600;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Pending Student Registrations</h2>

    <?php if ($result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Student ID</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                <td><?php echo htmlspecialchars($row['username']); ?></td>
                <td class="actions">
                    <a href="approval.php?action=approve&id=<?php echo $row['id']; ?>" class="approve">Approve</a>
                    <a href="approval.php?action=reject&id=<?php echo $row['id']; ?>" class="reject">Reject</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="no-data">No pending student registrations.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php $conn->close(); ?>
