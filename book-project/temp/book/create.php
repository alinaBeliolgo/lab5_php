<?php ob_start(); ?>

<h2>Добавить книгу</h2>

<form method="POST">
    <div>
        <label for="title">Название:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($_POST['title'] ?? '') ?>" required>
        <?php if (isset($errors['title'])): ?>
            <span class="error"><?= $errors['title'] ?></span>
        <?php endif; ?>
    </div>

    <div>
        <label for="category">Жанр:</label>
        <select id="category" name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>" 
                    <?= ($category['id'] == ($_POST['category_id'] ?? '')) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errors['category_id'])): ?>
            <span class="error"><?= $errors['category_id'] ?></span>
        <?php endif; ?>
    </div>

    <div>
        <label for="description">Описание:</label>
        <textarea id="description" name="description" required><?= 
            htmlspecialchars($_POST['description'] ?? '') 
        ?></textarea>
        <?php if (isset($errors['description'])): ?>
            <span class="error"><?= $errors['description'] ?></span>
        <?php endif; ?>
    </div>

    <button type="submit">Добавить</button>
    <a href="/">Отмена</a>
</form>

<?php
$content = ob_get_clean();
$title = 'Добавить книгу';
require '../layout.php';