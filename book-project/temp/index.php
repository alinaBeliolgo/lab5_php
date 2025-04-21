<?php ob_start(); ?>

<h2>Последние книги</h2>

<?php if (empty($books)): ?>
    <p>Книг пока нет. <a href="/book/create">Добавить первую</a></p>
<?php else: ?>
    <?php foreach ($books as $book): ?>
        <div class="book">
            <h3><a href="/book/<?= $book['id'] ?>"><?= htmlspecialchars($book['title']) ?></a></h3>
            <p>Жанр: <?= htmlspecialchars($book['category_name']) ?></p>
            <p><?= nl2br(htmlspecialchars(mb_substr($book['description'], 0, 200))) ?>...</p>
            <div class="actions">
                <a href="/book/<?= $book['id'] ?>/edit">Редактировать</a> |
                <a href="/book/<?= $book['id'] ?>/delete">Удалить</a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php
$content = ob_get_clean();
$title = 'Главная';
require 'layout.php';