<?php
session_start();
// Include any necessary files or configurations here
include "db_conn.php";

// Check if the post_id is provided in the URL
if (isset($_GET['id'])) {
    $post_id = $_GET['id'];
    $deleteSql = "DELETE FROM posts WHERE id = '$post_id'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "Post deleted successfully" . $post_id;
        header("Location: home.php");
        
    } else {
        echo "Error deleting post: " . $conn->error;
    }
} else {
    echo "Post ID not provided in the URL";
}

// Close the connection
$conn->close();
?>
