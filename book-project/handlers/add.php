<?php

require_once '../config/db.php';
require_once '../migration/01_category.php';
require_once '../migration/02_books.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category_id = $_POST['category'];
    $description = $_POST['description'];
    $created_at = $_POST['created_at'];
    

    if (!empty($title) && !empty($author) && !empty($category_id) && !empty($description) && !empty($created_at)) {
        if (!preg_match("/^[a-zA-Z0-9\s]+$/", $title)) {
            echo "Название книги содержит недопустимые символы.";
            exit;
        }
        
        // Проверка на корректность даты
        if (!strtotime($created_at)) {
            echo "Некорректная дата.";
            exit;
        }
        
        $stmt = $pdo->prepare("
            SELECT COUNT(*) FROM books WHERE title = ? AND author = ? AND category_id = ? AND description = ? AND created_at = ?
        ");
        $stmt->execute([$title, $author, $category_id, $description, $created_at]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo "Книга с такими данными уже существует.";
        } else {
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO books (title, author, category_id, description, created_at) VALUES (?, ?, ?, ?, ?)
                ");
                $stmt->execute([$title, $author, $category_id, $description, $created_at]);
                echo "Книга успешно добавлена!";
            } catch (PDOException $e) {
                echo "Ошибка при добавлении книги: " . htmlspecialchars($e->getMessage());
            }
        }
    } else {
        echo "Пожалуйста, заполните все поля.";
    }
           
   
}

