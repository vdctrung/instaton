<?php
session_start();
include "db_conn.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
else{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $user_name = $_SESSION['username'];

        $sql = "INSERT INTO posts (title, content, username) VALUES ('$title', '$content', '$user_name')";

        if ($conn->query($sql) === TRUE) {
            header("Location: home.php");
        }  else {
            echo "Error creating post";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>New Post</title>
</head>
<body>
    <div class='form-container'>
        <h2 class = 'h2-header'>Create a New Post</h2><br>
        <form action="new_post.php" method="post">
            <label for="title">Title:</label><br>
            <input class='input-area' type="text" name="title" required>
            <br>
            <label for="content">Content:</label><br>
            <textarea class ='text-area' name="content" rows="4" cols="50" required></textarea>
            <br><br>
            <input class= 'button' type="submit" value="Post"><br><br>
            <a href="home.php">Back to home</a>
        </form>
    </div>
</body>
</html>
