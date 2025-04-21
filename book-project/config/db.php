<?php


return [
    'driver' => 'pgsql',
    'host' => 'localhost',
    'port' => '5432',
    'dbname' => 'basadate_lab',
    'username' => 'laba',
    'password' => 'secure_password',
    'charset' => 'utf8',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];