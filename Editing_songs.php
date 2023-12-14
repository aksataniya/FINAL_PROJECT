<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$song_id = $_POST['song_id'];
$title = $_POST['title'];
$singer = $_POST['singer'];

// Check if the author exists, and insert if not
$singer = "INSERT INTO singers (name) SELECT * FROM (SELECT '$singer') AS tmp WHERE NOT EXISTS (SELECT name FROM singers WHERE name = '$singer')";
$conn->query($sqlSinger);
$singer_id = $conn->insert_id;

// Update the book with the valid author_id
$sql = "UPDATE books SET title = '$title', singer_id = '$singer_id' WHERE id = '$song_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "Error updating book: " . $conn->error;
}

$conn->close();
?>
