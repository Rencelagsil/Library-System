<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration Records</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your full CSS -->
    <style>
        /* Additional table styling */
        .table-container {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
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
</head>
<body>

    <div class="table-container">
        <div class="table-title">Student List</div>
        <?php
        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "library management");

        // Check connection
        if ($conn->connect_error) {
            die("<p style='color:red;'>Connection failed: " . $conn->connect_error . "</p>");
        }

        // Run the query
        $sql = "SELECT * FROM students_registration";
        $result = $conn->query($sql);

        // Check if query was successful
        if (!$result) {
            die("<p style='color:red;'>Query error: " . $conn->error . "</p>");
        }

        // Display results
        if ($result->num_rows > 0) {
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
                  </thead>
                  <tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['student_id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['password']}</td>
                        <td>{$row['register_at']}</td>
                        <td class='action-links'>
                            <a href='edit.php?id={$row['id']}'>Edit</a>
                            <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>
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

</body>
</html>
