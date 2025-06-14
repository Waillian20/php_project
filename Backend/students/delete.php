<?php
    include '../config.php';
    include '../../dbconnect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

        if ($id > 0) {
            try {
                $stmt = $pdo->prepare("DELETE FROM students WHERE id = :id");
                $stmt->execute(['id' => $id]);
                header('Location: lists.php');
                exit;
            } catch (PDOException $e) {
                echo "Error deleting record: " . $e->getMessage();
            }
        } else {
            echo "Invalid ID.";
        }
    } else {
        echo "Invalid request method.";
    }
?>