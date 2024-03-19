<?php
session_start();
include "db_conn.php";
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
$query = "SELECT id, title, content, username 
          FROM posts";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Home</title>
</head>
<body>
    <div class = "container">
        <header>Welcome to the Home Page</header>
        <nav>
            <ul>
                <li><a href="new_post.php">New Post</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
        <div class = "post">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            // echo "<h3>{$row['id']}</h3>";
            echo "<div class = 'post-user'><p>{$row['username']}</p></div>";
            echo "<h3>{$row['title']}</h3>";
            echo "<div><p>{$row['content']}</p></div>";

            // Hiển thị tùy chọn edit và xóa nếu bài viết thuộc về người đăng nhập
            if (isset($row['username']) && $row['username'] == $username) {
                echo "<p><a href='edit_post.php?id={$row['id']}'>Edit</a></p>";
                echo "<p><a href='delete_post.php?id={$row['id']}'>Delete</a></p><br><br>";
            }

            echo "</div>";
        }
        ?>
        </div>
    </div>    
</body>
</html>


