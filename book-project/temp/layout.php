<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Книжный проект</title>
</head>
<body>
    <header>
        <h1>Книжный проект</h1>
        <nav>
            <a href="index.php?route=index">Главная</a> |
            <a href="index.php?route=add">Добавить книгу</a>
            

        </nav>
    </header>
    <main>
        <?php
        // Подключаем содержимое текущей страницы
        if (file_exists($content)) {
            require_once $content;
        } else {
            echo "<p>Ошибка: файл шаблона не найден.</p>";
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2025 Книжный магаз</p>
    </footer>
</body>
</html>