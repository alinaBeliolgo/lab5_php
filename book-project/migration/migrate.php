<?php

require_once __DIR__ .'../config/db.php';

/**
 * Подключение файлов миграций.
 */
require_once __DIR__ .'/01_category.php';
require_once __DIR__ .'/02_books.php';


/**
 * @var array $migrations Список файлов миграций для выполнения.
 */
$migrations = [
    __DIR__ . '/migrations/01_category.php',
    __DIR__ . '/migrations/02_books.php',
];


/**
 * Выполнение миграций.
 * Перебирает список файлов миграций и выполняет их по очереди.
 */
foreach ($migrations as $migration) {
    echo "Запуск миграции: $migration\n";
    require $migration;
}
