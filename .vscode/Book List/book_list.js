document.addEventListener("DOMContentLoaded", function() {
    const books = [
        { title: "Noli Me Tangere", author: "José Rizal", genre: "Fiction", availability: "Available", year: 1887 },
        { title: "El Filibusterismo", author: "José Rizal", genre: "Fiction", availability: "Available", year: 1891 },
        { title: "The Philippine Revolution", author: "Apolinario Mabini", genre: "History", availability: "Not Available", year: 1899 },
        { title: "When the Rainbow Goddess Wept", author: " Cecilia Manguerra Brainard", genre: "Fiction", availability: "Available", year: 1993 },
        { title: "America Is in the Heart", author: "Carlos Bulosan", genre: "Biography", availability: "Available", year: 1946 },
        { title: "Dusk", author: "F. Sionil José", genre: "Fiction", availability: "Not Available", year: 1990 },
        { title: "The Man Who Would Be King", author: "Nick Joaquin", genre: "Fiction", availability: "Available", year: 1969 },
        { title: "Smaller and Smaller Circles", author: "F.H. Batacan", genre: "Mystery", availability: "Available", year: 1999 },
        { title: "Bayanihan: Philippine Folk Tales", author: "Corazon Alvina", genre: "Folklore", availability: "Not Available", year: 1950 },
        { title: "The Kite of Stars", author: "Dean Francis Alfar", genre: "Fantasy", availability: "Available", year: 2008 }

    ];


    function displayBooks(filteredBooks) {
        const tableBody = document.querySelector("#bookListTable tbody");
        tableBody.innerHTML = ''; 

        if (filteredBooks.length === 0) {
            const noDataRow = document.createElement("tr");
            const noDataCell = document.createElement("td");
            noDataCell.colSpan = 5;
            noDataCell.textContent = "No books found.";
            noDataRow.appendChild(noDataCell);
            tableBody.appendChild(noDataRow);
        } else {
            filteredBooks.forEach(book => {
                const row = document.createElement("tr");

                const titleCell = document.createElement("td");
                titleCell.textContent = book.title;
                row.appendChild(titleCell);

                const authorCell = document.createElement("td");
                authorCell.textContent = book.author;
                row.appendChild(authorCell);

                const genreCell = document.createElement("td");
                genreCell.textContent = book.genre;
                row.appendChild(genreCell);

                const availabilityCell = document.createElement("td");
                availabilityCell.textContent = book.availability;
                row.appendChild(availabilityCell);

                const yearCell = document.createElement("td");
                yearCell.textContent = book.year;
                row.appendChild(yearCell);

                tableBody.appendChild(row);
            });
        }
    }

    function filterBooks() {
        const searchQuery = document.getElementById("searchInput").value.toLowerCase();
        const genreFilter = document.getElementById("genreFilter").value;
        const availabilityFilter = document.getElementById("availabilityFilter").value;
        const yearFilter = document.getElementById("yearFilter").value;

        const filteredBooks = books.filter(book => {
            const matchesSearch = book.title.toLowerCase().includes(searchQuery) || 
                                  book.author.toLowerCase().includes(searchQuery) || 
                                  book.isbn && book.isbn.toLowerCase().includes(searchQuery);
            const matchesGenre = genreFilter ? book.genre === genreFilter : true;
            const matchesAvailability = availabilityFilter ? book.availability === availabilityFilter : true;
            const matchesYear = yearFilter ? book.year === parseInt(yearFilter) : true;

            return matchesSearch && matchesGenre && matchesAvailability && matchesYear;
        });

        displayBooks(filteredBooks);
    }

    document.getElementById("searchInput").addEventListener("input", filterBooks);
    document.getElementById("genreFilter").addEventListener("change", filterBooks);
    document.getElementById("availabilityFilter").addEventListener("change", filterBooks);
    document.getElementById("yearFilter").addEventListener("input", filterBooks);


    displayBooks(books);
});
