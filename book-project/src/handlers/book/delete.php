<?php

$bookId = (int)$_GET['id'] ?? 0;

$book = database()->query("SELECT * FROM books WHERE id = ?", [$bookId])->fetch();
if (!$book) die('Книга не найдена');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        database()->delete('books', $bookId);
        header('Location: /?deleted=1');
        exit;
    } catch (PDOException $e) {
        die("Ошибка: " . $e->getMessage());
    }
}

require __DIR__ . '/../../../templates/book/delete.php';