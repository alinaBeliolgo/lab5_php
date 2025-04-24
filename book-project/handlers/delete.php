<?php 

require_once '../config/db.php';


/**
 * Удаление книги из базы данных по идентификатору.
 * Проверяет наличие параметра 'id' в запросе GET.
 */
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bindParam(':id', $id , PDO::PARAM_INT);
    
    
    /**
     * Выполнение запроса и проверка результата.
     * Если запрос выполнен успешно, происходит перенаправление на главную страницу.
     * В противном случае выводится сообщение об ошибке.
     */
    if ($stmt->execute()) {
        header('Location: index.php?route=index');
        exit;
    } else {
        echo "Ошибка при удалении книги.";
    }
};