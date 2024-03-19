<?php
session_start();
include "db_conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["post_title"];
    $content = $_POST["post_content"];
    $username = $_SESSION["username"]; // User name obtained from the session

    // Perform any necessary validation

    // Save the new post to the database
    $sql = "INSERT INTO posts (title, content, username) VALUES ('$title', '$content', '$username')";

    if ($conn->query($sql) === TRUE) {
        echo "New post added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a New Post</title>
</head>
<body>

    <h2>Create a New Post</h2>
    
    <form method="post" action="create_post.php">
        <label for="post_title">Title:</label>
        <input type="text" name="post_title" required>
        
        <br>
        
        <label for="post_content">Content:</label>
        <textarea name="post_content" required></textarea>
        
        <br>
        
        <input type="submit" value="Create Post">
    </form>

</body>
</html>
