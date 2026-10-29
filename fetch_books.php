<?php
header("Content-Type: application/json");

// 1. CONNECT
$servername = "localhost";
$username = "2433752";
$password = "574sa7";
$dbname = "db2433752";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}

// 2. LOCAL DATABASE BOOKS
$sql = "SELECT book_id, book_name, book_description, released_date, rating, image_url FROM books";
$result = $conn->query($sql);

$localBooks = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        // Default image if empty
        if (empty($row["image_url"])) {
            $row["image_url"] = "default_cover.png";
        }

        $localBooks[] = $row;
    }
}

// 3. API BOOKS
$apiUrl = "https://www.googleapis.com/books/v1/volumes?q=black+romance";
$apiResponse = @file_get_contents($apiUrl);

$apiBooks = [];

if ($apiResponse !== false) {

    $apiData = json_decode($apiResponse, true);

    if (!empty($apiData['items'])) {

        foreach ($apiData['items'] as $item) {

            $apiBooks[] = [
                "book_id" => 0,
                "book_name" => $item["volumeInfo"]["title"] ?? "Unknown title",
                "book_description" => $item["volumeInfo"]["description"] ?? "No description",
                "released_date" => $item["volumeInfo"]["publishedDate"] ?? "Unknown",
                "rating" => $item["volumeInfo"]["averageRating"] ?? "N/A",
                "image_url" => $item["volumeInfo"]["imageLinks"]["thumbnail"] ?? "default_cover.png"
            ];
        }
    }
}

// 4. MERGE BOTH
$allBooks = array_merge($localBooks, $apiBooks);

// 5. RETURN
echo json_encode($allBooks);

$conn->close();
?>