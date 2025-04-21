<?php


require_once __DIR__ . '/../src/db.php';


$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

switch (true) {
    case $request === '/' && $method === 'GET':
        $books = database()->query("
            SELECT b.*, c.name as category_name 
            FROM books b 
            JOIN categories c ON b.category_id = c.id 
            ORDER BY b.created_at DESC
            LIMIT 10
        ")->fetchAll();
        
        require __DIR__ . '/../templates/index.php';
        break;
        
    case $request === '/book/create' && $method === 'GET':
        $categories = database()->query("SELECT * FROM categories")->fetchAll();
        require __DIR__ . '/../templates/book/create.php';
        break;
        
    case $request === '/book/create' && $method === 'POST':
        require __DIR__ . '/../src/handlers/book/create.php';
        break;
        
    case preg_match('#^/book/(\d+)$#', $request, $matches) && $method === 'GET':
        require __DIR__ . '/../src/handlers/book/show.php';
        break;
        
    case preg_match('#^/book/(\d+)/edit$#', $request, $matches) && $method === 'GET':
        require __DIR__ . '/../src/handlers/book/edit.php';
        break;
        
    case preg_match('#^/book/(\d+)/edit$#', $request, $matches) && $method === 'POST':
        require __DIR__ . '/../src/handlers/book/edit.php';
        break;
        
    case preg_match('#^/book/(\d+)/delete$#', $request, $matches) && $method === 'GET':
        require __DIR__ . '/../src/handlers/book/delete.php';
        break;
        
    case preg_match('#^/book/(\d+)/delete$#', $request, $matches) && $method === 'POST':
        require __DIR__ . '/../src/handlers/book/delete.php';
        break;
        
    default:
        http_response_code(404);
        echo 'Страница не найдена';
        break;
}