<?php
require 'session_check.php';

 // Verificação de cargo
 if (!isset($_SESSION['user_cargo']) || $_SESSION['user_cargo'] !== 'adm') {
    // Redirecione para uma página de erro ou exiba uma mensagem de acesso negado
    header('Location: erro_acesso.php'); // Página de erro personalizada
    exit(); // Encerra a execução do script
}

if(isset($_GET['arquivo'])){
    $arquivo = urldecode($_GET['arquivo']);
    
    if(file_exists($arquivo)){
        unlink($arquivo);
        echo "Nota fiscal excluída com sucesso.";
        header("Location: exibir_notasfiscais.php"); // Redireciona para exibir_notasfiscais.php
        exit; // Encerra o script para evitar que o restante do código seja executado
    } else {
        echo "Erro ao excluir a nota fiscal: arquivo não encontrado.";
    }
} else {
    echo "Erro ao excluir a nota fiscal: arquivo não especificado.";
}
?>
