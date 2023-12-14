<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$singer = $_POST['singer'];

$sqlSinger = "INSERT INTO singers (name) SELECT * FROM (SELECT '$singer') AS tmp WHERE NOT EXISTS (SELECT name FROM singers WHERE name = '$author')";
$conn->query($sqlSinger);
$singer_id = $conn->insert_id;

$sql = "INSERT INTO songs (title, singer_id) VALUES ('$title', '$singer_id')";
if ($conn->query($sql) === TRUE) {
    header("Location: Display.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
