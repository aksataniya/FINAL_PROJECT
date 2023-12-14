<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT books.id AS book_id, books.title, singers.name AS singer_name 
        FROM books 
        INNER JOIN singers ON books.singer_id = singers.id";

$result = $conn->query($sql);
$books = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Songs</title>
    <style>
        /* styles.css */

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}



        </style>
</head>
<body>
    <h1>Albums</h1>
    <table>
        <tr>
            <th>Song Name</th>
            <th>Singer</th>
            <th>Action</th>
        </tr>
        <?php foreach ($books as $book) : ?>
            <tr>
                <td><?php echo $book['title']; ?></td>
                <td><?php echo $book['author_name']; ?></td>
                <td>
                    <!-- Edit Form -->
                    <form action="edit_song.php" method="POST" style="display: inline;">
                        <input type="hidden" name="song_id" value="<?php echo $book['song_id']; ?>">
                        <input type="submit" value="Edit">
                    </form>
                    
                    <!-- Delete Form -->
                    <form action="Deleting.php" method="POST" style="display: inline;">
                        <input type="hidden" name="song_id" value="<?php echo $book['song_id']; ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="Inserting.php">Add New Song</a>
</body>
</html>
