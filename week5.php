<!DOCTYPE html>
<html>
<head>
  <title>Black Love</title>
  <!-- Add AJAX script to fetch book data -->
  <script>
    // This function runs when the page is loaded
    window.onload = function() {
      // Fetch the books using AJAX from fetch_books.php
      fetch('fetch_books.php')
        .then(response => response.json())  // Parse the JSON response
        .then(data => {
          let table = document.getElementById('bookTable');  // Get the table element by ID
          
          // Loop through each book and add it as a new row in the table
          data.forEach(book => {
            let row = table.insertRow();  // Create a new row for each book
            row.insertCell(0).textContent = book.book_name;        // Book name
            row.insertCell(1).textContent = book.book_description; // Book description
            row.insertCell(2).textContent = book.released_date;    // Release date
          });
        })
        .catch(error => console.error('Error:', error));  // Handle any errors
    };
  </script>
</head>
<body>

  <h1>Black Love</h1>
  <p>Black Romance to be recommended!</p>

  <!-- Table to display the book data dynamically -->
  <table id="bookTable" border="1">
    <thead>
      <tr>
        <th>Book Name</th>
        <th>Description</th>
        <th>Release Date</th>
      </tr>
    </thead>
    <tbody>
      <!-- Book rows will be dynamically added here by AJAX -->
    </tbody>
  </table>
<!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

  <!-- AJAX -->
  <script>
    const searchInput = document.getElementById('searchInput');

    function loadBooks() {
      fetch('fetch_books.php')
        .then(response => {
          if (!response.ok) {
            throw new Error('Failed to fetch books');
          }
          return response.json();
        })
        .then(data => {
          const tableBody = document.querySelector('#bookTable tbody');
          tableBody.innerHTML = '';

          data.forEach(book => {
            if (!book.id) return;

            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${book.book_name}</td>
              <td>${book.book_description}</td>
              <td>${book.released_date}</td>
              <td>
                <a href="edit_book.php?id=${book.id}" class="btn btn-warning btn-sm me-1">Edit</a>
                <button type="button" class="btn btn-danger btn-sm" onclick="deleteBook(${book.id})">Delete</button>
              </td>
            `;
            tableBody.appendChild(row);
          });
        })
        .catch(error => {
          console.error('Error loading books:', error);
        });
    }

    loadBooks();
</body>
</html>