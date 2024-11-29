<?php
session_start(); // Inicia a sessão

// Impede o cache da página
header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache");
header("Expires: 0");

// Verifica se a mensagem de boas-vindas está na sessão e exibe o alerta
if (isset($_SESSION['welcome_message'])) {
    echo "<script>alert('" . $_SESSION['welcome_message'] . "');</script>";
    // Limpa a mensagem para não exibir novamente nas próximas visitas
    unset($_SESSION['welcome_message']);
}

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Se não estiver logado, redireciona para a página de login
    header('Location: ../index.php');
    exit();
}

// Define as variáveis com base no cargo do usuário
$cargo = $_SESSION['user_cargo'] ?? '';

$isCliente = ($cargo === 'cliente');
$isOperador = ($cargo === 'operador');
$isAdm = ($cargo === 'adm');

// Exemplo de uso: restrição de acesso com base no cargo
if (!$isAdm && !$isOperador) {
    echo "<script>alert('Você não tem permissão para acessar esta página!');</script>";
    header('Location: ../index.php'); // Redireciona se não for admin
    exit();
}
?>
