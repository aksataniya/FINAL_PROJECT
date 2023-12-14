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

$sql = "DELETE FROM books WHERE id = '$song_id'";

if ($conn->query($sql) === TRUE) {
    header("Location: Display.php");
    exit();
} else {
    echo "Error deleting book: " . $conn->error;
}

$conn->close();
?>
