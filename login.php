<?php
session_start();
include "db_conn.php";
unset($_SESSION["fault"]);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get user input from the login form
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize user input to prevent SQL injection
    $username = $conn->real_escape_string($input_username);
    $password = $conn->real_escape_string($input_password);

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    

    if ($result->num_rows > 0) {
        // User authenticated, set session variable and redirect to dashboard
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit();
    } else {
        // Invalid login, show error message
        $error_message = "Invalid username or password. Please try again.";
        $_SESSION["fault"] = $error_message;
        
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class = "body">
        <div class="container">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <label class = "lb" for="username">Username</label>
                <input autocomplete = "off" type="text" class ="input" name="username" required><br><br>
        
                <label class = "lb" for="password">Password</label>
                <input type="password" class="input" name="password" required><br><br>
                <p class="error-message"><?php echo isset($_SESSION["fault"]) ? $_SESSION["fault"] : ''; ?></p>
                <button class = "btn-1" type="submit">Login</button>
                <h3>Don't have any account?</h3>

                <a href="signup.php">Sign Up</a>
                
            </form>
            
        </div>
    </div>
</body>
</html>

