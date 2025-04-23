<?php 

require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM books WHERE id = :id");
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        header('Location: index.php?route=index');
        exit;
    } else {
        echo "Ошибка при удалении книги.";
    }
};