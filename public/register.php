<?php
require_once "../app/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password

    if (!empty($username) && !empty($email) && !empty($_POST["password"])) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        if ($stmt->execute(['username' => $username, 'email' => $email, 'password' => $password])) {
            echo "Registration successful!";
        } else {
            echo "Failed to register.";
        }
    } else {
        echo "All fields are required!";
    }
}
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
