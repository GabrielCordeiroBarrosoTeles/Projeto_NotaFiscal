<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Configurações do banco de dados a partir do .env
$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];

// Conectar ao banco de dados usando MySQLi
$mysqli = new mysqli($host, $user, $password, $dbname);

// Verificar se a conexão foi bem-sucedida
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}
?>
