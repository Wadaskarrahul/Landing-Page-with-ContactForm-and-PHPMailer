<?php
$host = "localhost";      // Database host
$dbname = "rahul"; // Database name
$username = "root";       // DB username (default for XAMPP)
$password = "";           // DB password (empty for XAMPP)

try {
   /* $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enables error reporting
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Fetch data as associative arrays
    ]);*/
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // error reporting
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //fetch data as associative arrays
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
