<?php

require_once "config.php"; // Include the database connection file

class ContactFormHandler {
    private $pdo; // Keep property private

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function sanitizeInput($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    public function saveContact($name, $email, $message) {
       
        try {
            $stmt = $this->pdo->prepare("INSERT INTO contact_form (name, email, message) VALUES (:name, :email, :message)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':message', $message);
           return $stmt->execute();
        } catch (PDOException $e) {
            echo("Database Error: " . $e->getMessage());
            return false;
        }
    }

    public function getAllContacts() {
        return $this->pdo->query("SELECT * FROM contacts_form ORDER BY created_at DESC")->fetchAll();
    }
}

// Create an instance of the class
$contactFormHandler = new ContactFormHandler($pdo);
?>
