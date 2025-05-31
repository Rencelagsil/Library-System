<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "library management");
if ($conn->connect_error) {
    die("<p style='color:red;'>Connection failed: " . $conn->connect_error . "</p>");
}

// Initialize variables
$id = 0;
$email = $student_id = $username = $password = "";
$update_mode = false;
$message = "";

// Handle Create or Update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $student_id = $conn->real_escape_string($_POST['student_id']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update existing record
        $id = intval($_POST['id']);
        $sql = "UPDATE students_registration SET 
                    email='$email',
                    student_id='$student_id',
                    username='$username',
                    password='$password'
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $message = "Record updated successfully.";
        } else {
            $message = "Error updating record: " . $conn->error;
        }
    } else {
        // Insert new record
        $sql = "INSERT INTO students_registration (email, student_id, username, password, register_at) 
                VALUES ('$email', '$student_id', '$username', '$password', NOW())";

        if ($conn->query($sql) === TRUE) {
            $message = "New record created successfully.";
        } else {
            $message = "Error inserting record: " . $conn->error;
        }
    }
}

// Handle Delete request
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM students_registration WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        $message = "Record deleted successfully.";
    } else {
        $message = "Error deleting record: " . $conn->error;
    }
}

// Handle Edit request - fetch the record to edit
if (isset($_GET['edit'])) {
    $id = intval($_GET['edit']);
    $result = $conn->query("SELECT * FROM students_registration WHERE id=$id");
    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $email = $row['email'];
        $student_id = $row['student_id'];
        $username = $row['username'];
        $password = $row['password'];
        $update_mode = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Student Registration Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 2rem;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        h1 {
            text-align: center;
            color: #1e40af;
            margin-bottom: 1rem;
        }
        /* Add/Edit Form styling */
        form {
            margin-bottom: 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr auto;
            gap: 1rem;
            align-items: center;
        }
        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            padding: 0.5rem;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 1rem;
            width: 100%;
        }
        form button {
            padding: 0.5rem 1rem;
            background-color: #1e40af;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #374acb;
        }
        .message {
            margin-bottom: 1rem;
            font-weight: bold;
            color: green;
            text-align: center;
        }

        /* Hide form by default */
        #student-form {
            display: none;
            margin-bottom: 2rem;
        }
        /* Show form when .show class is added */
        #student-form.show {
            display: grid;
        }

        /* Show/hide Add button */
        #add-student-btn {
            display: inline-block;
            margin-bottom: 1rem;
            padding: 0.5rem 1rem;
            background-color: #1e40af;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #add-student-btn:hover {
            background-color: #374acb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        table thead {
            background-color: #1e40af;
            color: white;
        }

        table th, table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        table tr:hover {
            background-color: #f9fafb;
        }

        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #2563eb;
            font-weight: 500;
        }

        .action-links a:hover {
            text-decoration: underline;
        }

        .table-title {
            text-align: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            color: #1e40af;
            font-weight: bold;
        }
    </style>

    <script>
        function toggleForm(show) {
            const form = document.getElementById('student-form');
            const addBtn = document.getElementById('add-student-btn');
            if(show) {
                form.classList.add('show');
                addBtn.style.display = 'none';
            } else {
                form.classList.remove('show');
                addBtn.style.display = 'inline-block';
                // Clear form inputs only if not editing
                <?php if (!$update_mode): ?>
                form.reset();
                <?php endif; ?>
            }
        }
        window.onload = function() {
            // Show form if in edit mode
            <?php if ($update_mode): ?>
                toggleForm(true);
            <?php else: ?>
                toggleForm(false);
            <?php endif; ?>
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Student Registration Records</h1>

        <?php if ($message): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <!-- Add button -->
        <?php if (!$update_mode): ?>
            <button id="add-student-btn" onclick="toggleForm(true)">Add Student</button>
        <?php endif; ?>

        <!-- Form for Add / Edit -->
        <form id="student-form" method="post" action="">
            <input type="hidden" name="id" value="<?= $update_mode ? intval($id) : '' ?>" />
            <input type="email" name="email" placeholder="Email" required value="<?= htmlspecialchars($email) ?>" />
            <input type="text" name="student_id" placeholder="Student ID" required value="<?= htmlspecialchars($student_id) ?>" />
            <input type="text" name="username" placeholder="Username" required value="<?= htmlspecialchars($username) ?>" />
            <input type="password" name="password" placeholder="Password" required value="<?= htmlspecialchars($password) ?>" />
            <button type="submit"><?= $update_mode ? 'Update' : 'Add' ?></button>
            <?php if ($update_mode): ?>
                <a href="<?= $_SERVER['PHP_SELF'] ?>" style="margin-left: 1rem; text-decoration:none; color:#1e40af;">Cancel</a>
            <?php else: ?>
                <button type="button" onclick="toggleForm(false)" style="margin-left: 1rem; background:#ccc; color:#333;">Cancel</button>
            <?php endif; ?>
        </form>

        <!-- Student List Table -->
        <div class="table-container">
            <div class="table-title">Student List</div>
            <?php
            // Fetch all students
            $sql = "SELECT * FROM students_registration ORDER BY id DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo "<table>";
                echo "<thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Student ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Registered At</th>
                            <th>Actions</th>
                        </tr>
                      </thead><tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['student_id']) . "</td>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['password']) . "</td>
                            <td>{$row['register_at']}</td>
                            <td class='action-links'>
                                <a href='?edit={$row['id']}'>Edit</a>
                                <a href='?delete={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>
                            </td>
                          </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<p>No student records found.</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
