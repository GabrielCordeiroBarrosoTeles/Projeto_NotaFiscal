<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('Location: login.php'); // Redireciona para a página de login
    exit;
}

// Define o caminho para a pasta adm
$admPath = realpath(__DIR__ . '/../../sitefiscal/adm');

// Valida o arquivo solicitado para evitar ataques de path traversal
$request = $_GET['file'] ?? 'index.php';
$filePath = realpath($admPath . DIRECTORY_SEPARATOR . basename($request));

if ($filePath && strpos($filePath, $admPath) === 0 && file_exists($filePath)) {
    require $filePath;
} else {
    http_response_code(404);
    echo "Arquivo não encontrado.";
}
?>
