<?php ob_start(); ?>

<h2><?= htmlspecialchars($book['title']) ?></h2>
<p><strong>Жанр:</strong> <?= htmlspecialchars($book['category_name']) ?></p>
<p><strong>Описание:</strong></p>
<p><?= nl2br(htmlspecialchars($book['description'])) ?></p>
<p><small>Добавлено: <?= $book['created_at'] ?></small></p>

<div class="actions">
    <a href="/book/<?= $book['id'] ?>/edit">Редактировать</a> |
    <a href="/book/<?= $book['id'] ?>/delete" class="danger">Удалить</a> |
    <a href="/">Назад к списку</a>
</div>

<?php
$content = ob_get_clean();
$title = htmlspecialchars($book['title']);
require '../layout.php';