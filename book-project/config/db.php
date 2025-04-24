<?php

/**
 * Подключение конфигурационного файла.
 */
$config = require_once __DIR__ . DIRECTORY_SEPARATOR . 'config.php';


/**
 * Формирование строки DSN для подключения к базе данных.
 */
$dsn = $config['root'] . DIRECTORY_SEPARATOR .  $config['dsn'];


/**
 * Драйвер базы данных.
 */
$driver = $config['driver'];


/**
     * Создание подключения к базе данных с использованием PDO.
     * @var PDO $pdo Экземпляр PDO для работы с базой данных.
     */
try {
    $pdo = new PDO($driver . $dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    /**
     * Создание таблицы "books", если она не существует.
     * Таблица содержит информацию о книгах, включая название, автора, категорию и описание.
     */
    $pdo->exec("CREATE TABLE IF NOT EXISTS books (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        author TEXT NOT NULL,
        category_id INTEGER NOT NULL,
        description TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id)
    )");

}catch (PDOException $e) {
    die("Ошибка 500: cвяжитесь с администратором сайта.");
}