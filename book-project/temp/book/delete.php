<?php ob_start(); ?>

<h2>Удалить книгу "<?= htmlspecialchars($book['title']) ?>"</h2>
<p>Вы уверены, что хотите удалить эту книгу? Это действие нельзя отменить.</p>

<form method="POST">
    <button type="submit" class="danger">Да, удалить</button>
    <a href="/book/<?= $book['id'] ?>">Отмена</a>
</form>

<?php
$content = ob_get_clean();
$title = 'Удалить книгу';
require '../layout.php';