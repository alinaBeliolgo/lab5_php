<?php


require_once '../config/db.php';


$route = $_GET['route'] ?? 'index';


$template = '../temp/layout.php';


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
        http_response_code(404);
        $content = '../temp/404.php';
        break;
}


require_once $template;