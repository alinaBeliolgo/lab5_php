<?php


require_once '../config/db.php';

/**
 * Определение маршрута.
 * @var string $route Маршрут, полученный из параметра 'route' в запросе GET. 
 * Если параметр отсутствует, используется значение по умолчанию 'index'.
 */
$route = $_GET['route'] ?? 'index';


$template = '../temp/layout.php';



/**
 * Определение содержимого страницы на основе маршрута.
 * @var string $content Путь к файлу содержимого для текущего маршрута.
 */
switch ($route) {
    case 'index':
        $content = '../temp/index.php';
        break;
    case 'add':
        $content = '../temp/add.php';
        break;
    case 'list':
        $content = '../temp/list.php';
        break;
    case 'delete':
        $content = '../handlers/delete.php';
        break;
    default:
    // Если маршрут не найден, устанавливаем код ответа 404 и загружаем страницу 404
        http_response_code(404);
        $content = '../temp/404.php';
        break;
}


require_once $template;