<?php

session_start();

include "db_conn.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $nTitle = $_POST["new_title"];
        $nContent = $_POST["new_content"];
        $updateSql = "UPDATE posts SET title = '$nTitle', content = '$nContent' WHERE id = '$id'";
    
    if ($conn->query($updateSql) === TRUE) 
        header("Location: home.php");
    else 
        echo "Error updating post: ";// . $conn->error;
    }
} else {
    echo "Post ID not provided in the URL";
}
// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Update Post</title>
</head>
<body>
    <div class='form-container'>
        <h2 class = 'h2-header'>Update Post</h2><br>
        <form method="post" action="edit_post.php?id=<?php echo$id?>">
            <label for="new_title">New Title:</label><br>
            <input class='input-area'type="text" name="new_title" required><br>   
            
            <label for="new_content">New Content:</label><br>
            <textarea class='text-area' name="new_content" rows="4" cols="50" required></textarea><br><br>
            
            <input class='button' type="submit" value="Update Post"><br><br>
            <a href="home.php">Back to New Feed</a>
        </form>
    </div>
</body>
</html>

    

