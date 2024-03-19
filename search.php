<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>
<body>
<a href="home.php">Return</a>
<h2>List of posts:</h2>

<form action="" method="post">
    <label for="search">:</label>
    <input type="text" name="search" required>
    <input type="submit" value="Tìm Kiếm">
</form>

<div id="users-posts-list">
    <?php
    session_start();
    include "db_conn.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $searchTerm = $_POST['search'];

        $sql = "SELECT users.username as username, posts.title as title, posts.content as content 
                FROM users 
                LEFT JOIN posts ON users.username = posts.username 
                WHERE users.username LIKE '%$searchTerm%'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='user'>";
                echo "<p><strong>Tên Người Dùng:</strong> " . $row["username"] . "</p>";
                echo "</div>";

                if ($row["title"] !== null) {
                    echo "<div class='post'>";
                    echo "<p><strong>Tiêu Đề Bài Đăng:</strong> " . $row["title"] . "</p>";
                    echo "<p><strong>Nội Dung Bài Đăng:</strong> " . $row["content"] . "</p>";
                    echo "</div>";
                }
            }
        } else {
            echo "Không có người dùng nào với tên '$searchTerm'.";
        }
    }
    $conn->close(); 
    ?>
</div>

</body>
</html>
