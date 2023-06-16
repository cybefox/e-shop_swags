<?php
$host = "localhost"; // Update with your MySQL host
$db_name = "myapp_db"; // Update with your database name
$username = "root"; // Update with your MySQL username
$password = ""; // Update with your MySQL password

// Establish a database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
