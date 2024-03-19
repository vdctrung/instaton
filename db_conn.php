<?php
$host = "localhost";
$username = "admin";
$password = "123456";
$database = "instaton";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>