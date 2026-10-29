<!doctype html>
<html lang="en">
<head>
    <title>Black Love</title>
</head>
<body>

    <h1>Black Love</h1>
    <p>Black Romance to be recommended!</p>

    <?php
    // Connect to database
    include("db.php");

    // Run SQL query
    $sql = "SELECT * FROM books ORDER BY released_date";
    $results = mysqli_query($mysqli, $sql);
    ?>

    <table border="1">
        <tr>
            <th>Book ID</th>
            <th>Book Name</th>
            <th>Description</th>
            <th>Release Date</th>
        </tr>

        <?php while($a_row = mysqli_fetch_assoc($results)): ?>
        <tr>
            <td><?= $a_row['book_id'] ?></td>
            <td><?= $a_row['book_name'] ?></td>
            <td><?= $a_row['book_description'] ?></td>
            <td><?= $a_row['released_date'] ?></td>
        </tr>
        <?php endwhile; ?>

    </table>

</body>
</html>