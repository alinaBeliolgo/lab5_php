<?php

require_once __DIR__ . '/../config/db.php';

try {
    /**
     * Создание таблицы "categories", если она не существует.
     */
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS categories (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )"
    );


    /**
     * @var $defaultCategories Массив с названиями категорий по умолчанию.
     */
   $defaultCategories = ['Фантастика', 'Роман', 'Детектив', 'Научная литература', 'История'];

   foreach ($defaultCategories as $name) {
    /**
         * Подготовка SQL-запроса для вставки категории.
         * @var PDOStatement $stmt Подготовленный запрос для вставки данных.
         */
       $stmt = $pdo->prepare("INSERT OR IGNORE INTO categories (name) VALUES (:name)");
       $stmt->execute([':name' => $name]);
   }

/**
     * Обработка исключений при работе с базой данных.
     * Вывод сообщения об ошибке.
     * @param PDOException $e Исключение, выброшенное при ошибке PDO.
     */
} catch (PDOException $e) {
    echo "Ошибка 500: cвяжитесь с администратором сайта.";
}
