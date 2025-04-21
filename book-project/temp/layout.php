<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог книг - <?= $title ?? 'Главная' ?></title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .book { border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; }
        .error { color: red; font-size: 0.9em; }
        .danger { background-color: #dc3545; color: white; border: none; padding: 5px 10px; }
        .actions { margin-top: 10px; }
    </style>
</head>
<body>
    <header>
        <h1>Каталог книг</h1>
        <nav>
            <a href="/">Все книги</a> | 
            <a href="/book/create">Добавить книгу</a>
        </nav>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Каталог книг</p>
    </footer>
</body>
</html>