document.addEventListener("DOMContentLoaded", function() {
    const studentID = "2311600102";
    const studentName = "Lowrence Lagsil"; 

    const borrowedBooks = [
        { title: "Madame Bovary", author: "Gustave Flaubert", dueDate: "2025-04-15" },
        { title: "Wuthering Heights", author: "Emily Bronte", dueDate: "2025-04-30" },
        { title: "War and Peace", author: "Leo Tolstoy", dueDate: "2025-05-12" }
    
    ];

    
    document.getElementById("studentID").textContent = studentID;
    document.getElementById("studentName").textContent = studentName;


    function displayBorrowedBooks(books) {
        const tableBody = document.querySelector("#borrowedBooksTable tbody");
        tableBody.innerHTML = ''; // Clear existing rows

        if (books.length === 0) {
            document.getElementById("noBooksMessage").style.display = "block";
        } else {
            document.getElementById("noBooksMessage").style.display = "none";
            books.forEach(book => {
                const row = document.createElement("tr");

                const titleCell = document.createElement("td");
                titleCell.textContent = book.title;
                row.appendChild(titleCell);

                const authorCell = document.createElement("td");
                authorCell.textContent = book.author;
                row.appendChild(authorCell);

                const dueDateCell = document.createElement("td");
                dueDateCell.textContent = book.dueDate;
                row.appendChild(dueDateCell);

                tableBody.appendChild(row);
            });
        }
    }

    // Call the function to populate the table
    displayBorrowedBooks(borrowedBooks);
});
