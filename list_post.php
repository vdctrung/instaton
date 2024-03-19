<?php
session_start();
include "db_conn.php";
// SQL query with JOIN to retrieve information from both tables
$sql = "SELECT users.username, posts.title, posts.content
        FROM users
        INNER JOIN posts ON users.id = posts.user_id";

$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"] . "<br>";
        echo "Title: " . $row["title"] . "<br>";
        echo "Content: " . $row["content"] . "<br>";
        echo "<hr>";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
