<?php ob_start(); ?>

<h2>Редактировать книгу</h2>

<form method="POST">
    <div>
        <label for="title">Название:</label>
        <input type="text" id="title" name="title" 
               value="<?= htmlspecialchars($_POST['title'] ?? $book['title']) ?>" required>
        <?php if (isset($errors['title'])): ?>
            <span class="error"><?= $errors['title'] ?></span>
        <?php endif; ?>
    </div>

    <div>
        <label for="category">Жанр:</label>
        <select id="category" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" 
                    <?= ($category['id'] == ($_POST['category_id'] ?? $book['category_id'])) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="description">Описание:</label>
        <textarea id="description" name="description" required><?= 
            htmlspecialchars($_POST['description'] ?? $book['description']) 
        ?></textarea>
    </div>

    <button type="submit">Сохранить</button>
    <a href="/book/<?= $book['id'] ?>">Отмена</a>
</form>

<?php
$content = ob_get_clean();
$title = 'Редактировать: ' . htmlspecialchars($book['title']);
require '../layout.php';