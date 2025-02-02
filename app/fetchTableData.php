<?php
require_once 'config.php'; // Include database connection

try {
    $stmt = $pdo->prepare("SELECT id, first_name,last_name,office FROM employees");
    $stmt->execute();
    $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return JSON response
    echo json_encode($projects);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
