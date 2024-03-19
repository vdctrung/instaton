<?php
include "db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection (replace with your actual database details)

    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    // Get user input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];


    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    $check_username_result = $conn->query($check_username_query);

    if ($check_username_result->num_rows > 0) {
        $error_message = "username '$username' is already taken. Please choose a different username.";
        $_SESSION["fault"] = $error_message;
        
    } else {
        $insert_user_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($insert_user_query) === TRUE) {
            $_SESSION["username"] = $username;
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Registration failed. Please try again.";
            
        }
    }

    $conn->close();
}
$error_message = isset($_SESSION["error_message"]) ? $_SESSION["error_message"] : null;

unset($_SESSION["error_message"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="styles.css">
</head> 
<body>
    <div class = "body">
        <div class="container">
            <h2>Signup</h2>
            <form action="signup.php" method="post">
                <label class = "lb" for="username">Username</label>
                <input autocomplete = "off" type="text" class="input" name="username" required><br><br>

                <label class = "lb" for="password">Password</label>
                <input type="password" class="input" name="password" required><br><br>
                <p class="error-message"><?php echo isset($_SESSION["fault"]) ? $_SESSION["fault"] : ''; ?></p>
                <button class = "btn-1" type="submit">Signup</button>
                <h3>Already have an account</h3>

                <a href="login.php">Login</a>
                
            </form>
        </div>
    </div>
</body>
</html>
