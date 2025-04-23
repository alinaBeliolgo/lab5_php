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
                    INSERT INTO books (title, author, category_id, description, created_at)
                    VALUES (?, ?, ?, ?, ?)
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

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить книгу</title>
</head>
<body>
    <h1>Добавить книгу</h1>
    <form method="post">
        <label>Название: <input type="text" name="title" required></label><br>
        <label>Автор: <input type="text" name="author" required></label><br>
        <label>Описание: <textarea name="description"></textarea></label><br>
        <label>Категория:
            <select name="category" required>
                <?php
                $stmt = $pdo->query("SELECT * FROM categories");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
                ?>
            </select>
        </label><br>
        <label>Дата добавления: <input type="date" name="created_at" value="<?= date('Y-m-d') ?>" readonly></label><br>
       
        <button type="submit">Сохранить</button>

    </form>
    <a href="index.php">Назад</a>
</body>
</html>