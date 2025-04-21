<?php
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct() {
        $config = require __DIR__ . '/../config/db.php';
        
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        
        try {
            $this->pdo = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            throw new PDOException("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $this->query($sql, $data);
        
        return $this->pdo->lastInsertId();
    }

    public function update($table, $id, $data) {
        $set = implode(', ', array_map(
            fn($key) => "$key = :$key", 
            array_keys($data)
        ));
        
        $sql = "UPDATE $table SET $set WHERE id = :id";
        $this->query($sql, array_merge($data, ['id' => $id]));
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
        return $this->query($sql, ['id' => $id])->rowCount();
    }
}

function database() {
    return Database::getInstance();
}