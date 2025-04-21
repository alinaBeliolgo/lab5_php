<?php


$bookId = (int)$_GET['id'] ?? 0;

$book = database()->query("
    SELECT b.*, c.name as category_name 
    FROM books b 
    JOIN categories c ON b.category_id = c.id 
    WHERE b.id = ?
", [$bookId])->fetch();

if (!$book) {
    http_response_code(404);
    die('Книга не найдена');
}

require __DIR__ . '/../../../templates/book/show.php';