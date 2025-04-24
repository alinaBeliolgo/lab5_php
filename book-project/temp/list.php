<?php

require_once '../config/db.php';

/**
 * Получение ID книги из параметра запроса.
 */
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : null;


/**
 * Проверка корректности ID книги.
 * Если ID отсутствует или некорректен, выводится сообщение об ошибке.
 */
if (!$id || !is_numeric($id)) {
    echo "Некорректный ID книги.";
    exit;
}

/**
 * Подготовка SQL-запроса для получения информации о книге по ID.
 * Запрос включает JOIN с таблицей категорий для получения названия категории.
 */
try {
    $stmt = $pdo->prepare("
        SELECT books.*, categories.name as category_name
        FROM books
        JOIN categories ON books.category_id = categories.id
        WHERE books.id = ?
    ");
    $stmt->execute([$id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    /**
     * Проверка наличия книги с указанным ID.
     * Если книга не найдена, выводится сообщение об ошибке.
     */
    if (!$book) {
        echo "Книга не найдена.";
        exit;
    }
} catch (PDOException $e) {
    echo "Ошибка при загрузке книги: ";
    exit;
}
?>

<!-- HTML-код для отображения информации о книге -->
<h2><?= htmlspecialchars($book['title']) ?></h2>
<p><strong>Автор:</strong> <?= htmlspecialchars($book['author']) ?></p>
<p><strong>Категория:</strong> <?= htmlspecialchars($book['category_name']) ?></p>
<p><strong>Описание:</strong> <?= nl2br(htmlspecialchars($book['description'])) ?></p>
<p><strong>Дата добавления:</strong> <?= htmlspecialchars($book['created_at']) ?></p>

<a href="index.php?route=index">Назад</a>
