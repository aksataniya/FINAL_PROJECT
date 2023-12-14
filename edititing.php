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

$sql = "SELECT songs.id AS song_id, songs.title, singers.name AS singer_name 
        FROM songs 
        INNER JOIN singers ON songs.singer_id = singers.id
        WHERE songs.id = '$song_id'";

$result = $conn->query($sql);
$song = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Song</title>
</head>
<body>
    <h1>Edit Song</h1>
    <form action="Editing_songs.php" method="POST">
        <input type="hidden" name="song_id" value="<?php echo $song['song_id']; ?>">

        <label for="title">Title of Song:</label>
        <input type="text" id="title" name="title" value="<?php echo $song['title']; ?>" required><br><br>

        <label for="singer">Singer:</label>
        <input type="text" id="singer" name="singer" value="<?php echo $song['singer_name']; ?>" required><br><br>

        <input type="submit" value="Update Song">
    </form>
</body>
</html>
