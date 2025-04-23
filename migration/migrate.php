<?php

require_once __DIR__ .'../config/db.php';
require_once __DIR__ .'/01_category.php';
require_once __DIR__ .'/02_books.php';

$migrations = [
    __DIR__ . '/migrations/01_category.php',
    __DIR__ . '/migrations/02_books.php',
];

foreach ($migrations as $migration) {
    echo "Запуск миграции: $migration\n";
    require $migration;
}
