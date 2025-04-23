<?php
require_once '../config/db.php';

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить книгу</title>
</head>
<body>
    <h1>Добавить книгу</h1>
    <form method="post">
        <label>Название: <input type="text" name="title" required></label><br>
        <label>Автор: <input type="text" name="author" required></label><br>
        <label>Описание: <textarea name="description"></textarea></label><br>
        <label>Категория:
            <select name="category" required>
                <?php
                $stmt = $pdo->query("SELECT * FROM categories");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=\"{$row['id']}\">{$row['name']}</option>";
                    
                }
                ?>
            </select>
        </label><br>
        <label>Дата добавления: <input type="date" name="created_at" value="<?= date('Y-m-d') ?>"></label><br>
       
        <button type="submit">Сохранить</button>

    </form>
    <a href="../public/index.php">Назад</a>
</body>
</html>