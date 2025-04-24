<?php

require_once __DIR__ . '/../config/db.php';


try {
    /**
     * Создание таблицы "books", если она не существует.
     * Таблица содержит информацию о книгах, включая название, автора, категорию и описание.
     *
     *  Поля:
     * - id: уникальный идентификатор книги (автоинкремент).
     * - title: название книги (обязательное поле).
     * - category_id: идентификатор категории (обязательное поле).
     * - author: автор книги (необязательное поле).
     * - description: описание книги (необязательное поле).
     * - created_at: дата и время создания записи.
     * 
     * Связи:
     * - category_id ссылается на id в таблице "categories".
     * - При удалении категории все связанные книги также удаляются (ON DELETE CASCADE).
     */
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS books (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            category_id INTEGER NOT NULL,
            author TEXT,
            description TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
        )"
    
    );


} catch (PDOException $e) {
    echo "Ошибка 500: cвяжитесь с администратором сайта.";
}
