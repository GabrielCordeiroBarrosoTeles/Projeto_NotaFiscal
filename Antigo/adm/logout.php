<?php
session_start(); // Inicia a sessão
session_unset(); // Limpa todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redireciona o usuário para a página de login (index.php)
header('Location: ../index.php');
exit();
?>
