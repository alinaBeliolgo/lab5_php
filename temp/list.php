<?php

require_once __DIR__ . '/../config/db.php';



$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("
        SELECT books.*, categories.name as category_name
        FROM books
        JOIN categories ON books.category.id = categories.id
        WHERE books.id = ?
    ");
    $stmt->execute([$id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);




    if ($book):
?>
        <h2><?= htmlspecialchars($book['title']) ?></h2>
        <p><strong>Автор:</strong> <?= htmlspecialchars($book['author']) ?></p>
        <p><strong>Категория:</strong> <?= htmlspecialchars($book['category_name']) ?></p>
        <p><strong>Описание:</strong> <?= nl2br(htmlspecialchars($book['description'])) ?></p>
        <p><strong>Дата добавления:</strong> <?= htmlspecialchars($book['created_at']) ?></p>
        <a href="?page=index">Назад к списку</a>
<?php
    else:
        echo "Книга не найдена.";
    endif;
} else {
    echo "ID не указан.";
}
