<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/dbcon.php';

// Roteador simples
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($requestUri) {
    case '/':
        require_once __DIR__ . '/public/home.php';
        break;

    case '/produtos':
        require_once __DIR__ . '/public/produtos.php';
        break;

    case '/contato':
        require_once __DIR__ . '/public/contato.php';
        break;

    default:
        http_response_code(404);
        require_once __DIR__ . '/public/404.php';
        break;
}
?>
