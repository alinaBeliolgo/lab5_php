<?php



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    
    $title = trim($_POST['title'] ?? '');
    $categoryId = (int)($_POST['category_id'] ?? 0);
    $description = trim($_POST['description'] ?? '');

    if (empty($title)) $errors['title'] = 'Название обязательно';
    if (strlen($title) > 255) $errors['title'] = 'Название слишком длинное';
    
    $validCategories = database()->query("SELECT id FROM categories")->fetchAll(PDO::FETCH_COLUMN);
    if (!in_array($categoryId, $validCategories)) {
        $errors['category_id'] = 'Неверная категория';
    }

    if (empty($description)) $errors['description'] = 'Описание обязательно';

    if (empty($errors)) {
        try {
            $bookId = database()->insert('books', [
                'title' => $title,
                'category_id' => $categoryId,
                'description' => $description,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            header("Location: /book/{$bookId}");
            exit;
        } catch (PDOException $e) {
            die("Ошибка: " . $e->getMessage());
        }
    }
}

$categories = database()->query("SELECT * FROM categories")->fetchAll();
require __DIR__ . '/../../../templates/book/create.php';