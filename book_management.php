<?php
// Connect to your database — update credentials as needed
$conn = new mysqli('localhost', 'root', '', 'library management');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM books WHERE id = $id");
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?')); // redirect to clean URL
    exit;
}

// Fetch all books for display in the table
$books_result = $conn->query("SELECT * FROM books ORDER BY id DESC");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Management - Lathoug's Library</title>
  <link rel="stylesheet" href="library.css">
</head>
<body>
  <header class="header">
    <h1>Book Management</h1>
  </header>

  <main class="main-dashboard">
    <section class="card">
      <h2>Add New Book</h2>
      <form action="add_book.php" method="POST" class="user-form" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Book Title" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="text" name="isbn" placeholder="ISBN" required>
        <input type="text" name="publisher" placeholder="Publisher" required>
        <input type="number" name="year" placeholder="Publication Year" min="1000" max="2025" required>
        
        <select name="category" required>
          <option value="">Select a category</option>
          <option value="Fiction">Fiction</option>
          <option value="Non-Fiction">Non-Fiction</option>
          <option value="Science">Science</option>
          <option value="History">History</option>
          <option value="Biography">Biography</option>
        </select>

        <input type="number" name="copies" placeholder="Number of Copies" min="1" required>
        <input type="text" name="shelf" placeholder="Shelf Location" required>
        
        <label for="cover">Book Cover Image (Optional):</label>
        <input type="file" id="cover" name="cover" accept="image/*">

        <button type="submit" class="btn">Add Book</button>
      </form>
    </section>

    <section class="card">
      <h2>Manage Existing Books</h2>
      <table>
        <thead>
          <tr><th>Title</th><th>Author</th><th>ISBN</th><th>Category</th><th>Copies</th><th>Action</th></tr>
        </thead>
        <tbody>
          <?php if ($books_result->num_rows > 0): ?>
            <?php while ($book = $books_result->fetch_assoc()): ?>
              <tr>
                <td><?php echo htmlspecialchars($book['title']); ?></td>
                <td><?php echo htmlspecialchars($book['author']); ?></td>
                <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                <td><?php echo htmlspecialchars($book['category']); ?></td>
                <td><?php echo htmlspecialchars($book['copies']); ?></td>
                <td>
                  <a href="edit_book.php?id=<?php echo $book['id']; ?>"><button>Edit</button></a>
                  <a href="?delete=<?php echo $book['id']; ?>" onclick="return confirm('Are you sure you want to delete this book?');"><button>Delete</button></a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="5" style="text-align:center;">No books found.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
  </main>
</body>
</html>

