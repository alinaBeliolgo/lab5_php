<?php

require_once '../config/db.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список книг:</title>
</head>
<body>
    <h1>Книги</h1>
    <a href="add.php">Добавить книгу</a>
    <ul>
    <?php
        try {
            $stmt = $pdo->query("
                SELECT books.id, books.title, books.author, books.created_at, categories.name as category_name
                FROM books
                JOIN categories ON books.category = categories.id
            ");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>
                        <strong>" . htmlspecialchars($row['title']) . "</strong> — " . htmlspecialchars($row['author']) . 
                        " (Категория: " . htmlspecialchars($row['category_name']) . ", Дата: " . htmlspecialchars($row['created_at']) . ")
                        <a href='list.php?id=" . $row['id'] . "'>Подробнее</a> | 
                        <a href='delete.php?id=" . $row['id'] . "'>Удалить</a>
                      </li>";
            }
        } catch (PDOException $e) {
            echo "Ошибка при загрузке списка книг: " . htmlspecialchars($e->getMessage());
        }
    ?>
    </ul>
</body>
</html>