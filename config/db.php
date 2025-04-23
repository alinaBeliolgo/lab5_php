<?php

$config = require_once __DIR__ . DIRECTORY_SEPARATOR . 'config.php';

$dsn = $config['root'] . DIRECTORY_SEPARATOR .  $config['dsn'];

$driver = $config['driver'];




try {
    $pdo = new PDO($driver . $dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS books (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        author TEXT NOT NULL
    )");

}catch (PDOException $e) {
    die("Error connection: " . $e->getMessage());
}