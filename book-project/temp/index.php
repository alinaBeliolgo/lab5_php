<?php

require_once '../config/db.php';


try {
    /**
     * Получение списка книг с категориями из базы данных.
     * Выполняется SQL-запрос с объединением таблиц `books` и `categories`.
     * 
     * @var PDOStatement $stmt Подготовленный запрос для выборки данных.
     */
    $stmt = $pdo->query("
        SELECT books.id, books.title, books.author, books.created_at, categories.name as category_name
        FROM books
        JOIN categories ON books.category_id = categories.id
    ");

    /**
     * Вывод списка книг в виде HTML-списка.
     */
    echo "<ul>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>
                <strong>" . htmlspecialchars($row['title']) . "</strong> — " . htmlspecialchars($row['author']) . 
                " (Категория: " . htmlspecialchars($row['category_name']) . ", Дата: " . htmlspecialchars($row['created_at']) . ")
                <a href='index.php?route=list&id=" . $row['id'] . "'>Подробнее</a>|
                <a href='index.php?route=delete&id=" . $row['id'] . "'>Удалить</a>
              </li>";
    }
    echo "</ul>";
} catch (PDOException $e) {
    echo "Ошибка при загрузке списка книг";;
}
