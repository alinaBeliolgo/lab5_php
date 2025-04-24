<?php

/**
 * Логика и шаблон объединены в одном файле, так как:
 * 1. При разделении логики и шаблона форма переставала работать корректно (не сохраняла книгу).
 * 2. Проблемы с передачей данных между контроллером и шаблоном усложняли реализацию.
 * 3. Для упрощения и устранения ошибок было принято решение оставить всё в одном файле.
 */
require_once '../config/db.php';

require_once '../migration/01_category.php';

require_once '../migration/02_books.php';



$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /**
     * Получение данных из формы.
     * @var string $title Название книги.
     * @var string $author Автор книги.
     * @var string $category_id Идентификатор категории книги.
     * @var string $description Описание книги.
     * @var string $created_at Дата добавления книги.
     */
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category_id = $_POST['category'];
    $description = trim($_POST['description']);
    $created_at = $_POST['created_at'];


    /**
     * Валидация данных формы.
     */
    if ($title === '' || $author === '' || $category_id === '' || $description === '' || $created_at === '') {
        $message = 'Пожалуйста, заполните все поля.';

    } elseif (!preg_match('/^[a-zA-ZА-Яа-я0-9\s]+$/u', $title)) {
        $message = 'Название книги содержит недопустимые символы.';

    } elseif (!strtotime($created_at)) {
        $message = 'Некорректная дата.';

    } else {
        /**
         * Проверка на существование книги с такими же данными.
         */
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM books 
            WHERE title = ? 
              AND author = ? 
              AND category_id = ? 
              AND description = ? 
              AND created_at = ?
        ");

        $stmt->execute([$title, $author, $category_id, $description, $created_at]);
        if ($stmt->fetchColumn() > 0) {
            $message = 'Книга с такими данными уже существует.';
        } else {
            try {
                /**
                 * Добавление новой книги в базу данных.
                 */
                $stmt = $pdo->prepare("
                    INSERT INTO books (title, author, category_id, description, created_at) VALUES (?, ?, ?, ?, ?)
                ");
                $stmt->execute([$title, $author, $category_id, $description, $created_at]);
                $message = 'Книга успешно добавлена!';
                $title = $author = $description = '';
                $category_id = '';
                $created_at = date('Y-m-d');
            } catch (PDOException $e) {
                $message = 'Ошибка при добавлении книги.';
            }
        }
    }
} else {
    $title = $author = $description = '';
    $created_at = date('Y-m-d');
    $category_id = '';
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

    <?php if ($message !== ''): ?>
        <p style="color: <?= strpos($message, 'успешно') !== false ? 'green' : 'red' ?>;">
            <?= htmlspecialchars($message) ?>
        </p>
    <?php endif; ?>

    <form method="post">
        <label>Название:
            <input type="text" name="title" required value="<?= htmlspecialchars($title) ?>">
        </label><br>

        <label>Автор:
            <input type="text" name="author" required value="<?= htmlspecialchars($author) ?>">
        </label><br>

        <label>Описание:
            <textarea name="description"><?= htmlspecialchars($description) ?></textarea>
        </label><br>

        <label>Категория:
            <select name="category" required>
                <option value="">Select...</option>
                <?php
                /**
                 * Получение списка категорий из базы данных.
                 */
                $stmt = $pdo->query("SELECT id, name FROM categories");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?= $row['id'] ?>"
                        <?= $row['id'] == $category_id ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </label><br>

        <label>Дата добавления:
            <input type="date" name="created_at" value="<?= htmlspecialchars($created_at) ?>">
        </label><br>

        <button type="submit">Сохранить</button>
    </form>

    <p><a href="../public/index.php">Назад</a></p>
</body>
</html>
