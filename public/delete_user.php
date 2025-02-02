<?php
include '../app/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the delete statement
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "User deleted successfully.";
        header("Location: index.php"); // Redirect after deletion
    } else {
        echo "Error deleting user.";
    }
}
?>
