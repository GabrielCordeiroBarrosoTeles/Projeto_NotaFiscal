<?php
require_once __DIR__ . '/../config/config.php';

$backupFile = __DIR__ . '/fc.sql';
$dbHost = $_ENV['DB_HOST'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];
$dbName = $_ENV['DB_NAME'];

if (!file_exists($backupFile)) {
    die("Arquivo de backup não encontrado.");
}

$command = "mysql -h $dbHost -u $dbUser -p$dbPass $dbName < $backupFile";
$output = null;
$returnVar = null;

exec($command, $output, $returnVar);

if ($returnVar === 0) {
    echo "Banco de dados restaurado com sucesso.";
} else {
    echo "Erro ao restaurar o banco de dados.";
}
?>
