<?php
// Connect to database and fetch books
$books = [];
$conn = new mysqli("localhost", "root", "", "library management");

if (!$conn->connect_error) {
    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $books[] = [
            'title' => $row['title'],
            'author' => $row['author'],
            'category' => $row['category'],
            'availability' => $row['copies'] > 0 ? 'Available' : 'Not Available',
            'publication_year' => $row['publication_year'],
            'isbn' => $row['isbn']
        ];
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Book List</title>
  <style>
    /* Reset and base */
    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
      min-height: 100vh;
      color: #333;
      padding: 2rem;
    }
    .container {
      max-width: 960px;
      margin: 0 auto;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
      padding: 2rem 3rem;
    }
    h1 {
      font-size: 2rem;
      color: #1e40af;
      margin-bottom: 1.5rem;
      font-weight: 700;
      text-align: center;
    }
    .search-filters {
      margin-bottom: 1.5rem;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }
    .filters {
      display: flex;
      gap: 1rem;
      flex-wrap: wrap;
      justify-content: center;
    }
    input[type="text"], input[type="number"], select {
      padding: 10px 15px;
      border: 1.5px solid #cbd5e1;
      border-radius: 8px;
      font-size: 1rem;
      color: #1f2937;
      transition: border-color 0.3s ease;
      min-width: 150px;
    }
    input[type="text"]:focus,
    input[type="number"]:focus,
    select:focus {
      outline: none;
      border-color: #3b82f6;
      box-shadow: 0 0 8px #3b82f6aa;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0 0 15px rgba(0,0,0,0.05);
      border-radius: 12px;
      overflow: hidden;
    }
    thead {
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      color: white;
      font-weight: 600;
      font-size: 1rem;
    }
    th, td {
      padding: 15px 20px;
      border-bottom: 1px solid #e2e8f0;
      text-align: left;
    }
    tbody tr:hover {
      background-color: #e0e7ff;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    /* Responsive */
    @media (max-width: 600px) {
      .filters {
        flex-direction: column;
        align-items: stretch;
      }
      input[type="text"], input[type="number"], select {
        width: 100%;
      }
      th, td {
        padding: 12px 10px;
      }
    }
  </style>
</head>
<body>
<div class="container">
  <h1>Available Books</h1>

  <div class="search-filters">
    <input type="text" id="searchInput" placeholder="Search by title, author, or ISBN" />
    <div class="filters">
      <select id="genreFilter">
        <option value="">All Genres</option>
        <option value="Fiction">Fiction</option>
        <option value="Non-Fiction">Non-Fiction</option>
        <option value="Science">Science</option>
        <option value="History">History</option>
        <option value="Folklore">Folklore</option>
        <option value="Biography">Biography</option>
        <option value="Mystery">Mystery</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Drama">Drama</option>
      </select>

      <select id="availabilityFilter">
        <option value="">All Availability</option>
        <option value="Available">Available</option>
        <option value="Not Available">Not Available</option>
      </select>

      <input type="number" id="yearFilter" placeholder="Publication Year" />
    </div>
  </div>

  <table id="bookListTable" aria-label="List of available books">
    <thead>
      <tr>
        <th>Book Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Availability</th>
        <th>Publication Year</th>
      </tr>
    </thead>
    <tbody id="bookTableBody">
      <?php foreach ($books as $book): ?>
      <tr>
        <td><?= htmlspecialchars($book['title']) ?></td>
        <td><?= htmlspecialchars($book['author']) ?></td>
        <td><?= htmlspecialchars($book['category']) ?></td>
        <td><?= htmlspecialchars($book['availability']) ?></td>
        <td><?= htmlspecialchars($book['publication_year']) ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchInput");
    const genreFilter = document.getElementById("genreFilter");
    const availabilityFilter = document.getElementById("availabilityFilter");
    const yearFilter = document.getElementById("yearFilter");
    const tableBody = document.getElementById("bookTableBody");

    const originalRows = Array.from(tableBody.querySelectorAll("tr"));

    function filterBooks() {
      const search = searchInput.value.toLowerCase();
      const genre = genreFilter.value;
      const availability = availabilityFilter.value;
      const year = yearFilter.value;

      tableBody.innerHTML = "";

      originalRows.forEach(row => {
        const cells = row.querySelectorAll("td");
        const title = cells[0].textContent.toLowerCase();
        const author = cells[1].textContent.toLowerCase();
        const category = cells[2].textContent;
        const status = cells[3].textContent;
        const pubYear = cells[4].textContent;

        const matchSearch = title.includes(search) || author.includes(search) || cells[0].textContent.includes(search);
        const matchGenre = !genre || category === genre;
        const matchAvailability = !availability || status === availability;
        const matchYear = !year || pubYear === year;

        if (matchSearch && matchGenre && matchAvailability && matchYear) {
          tableBody.appendChild(row);
        }
      });
    }

    searchInput.addEventListener("input", filterBooks);
    genreFilter.addEventListener("change", filterBooks);
    availabilityFilter.addEventListener("change", filterBooks);
    yearFilter.addEventListener("input", filterBooks);
  });
</script>
</body>
</html>
