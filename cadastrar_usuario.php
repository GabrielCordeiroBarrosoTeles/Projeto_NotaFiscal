<?php
session_start();

// Definindo as constantes para conexão com o banco de dados
define('DB_HOST', 'localhost');   // Nome do host (geralmente localhost)
define('DB_USER', 'root');         // Nome do usuário do banco
define('DB_PASSWORD', '');         // Senha do banco (deixe vazio se não houver senha)
define('DB_NAME', 'fc');           // Nome do banco de dados

// Conectar ao banco de dados
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Verificar se ocorreu erro na conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe o login e a senha do formulário
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Validar se os campos não estão vazios
    if (empty($login) || empty($senha)) {
        echo "Preencha todos os campos.";
        exit();
    }

    // Criptografar a senha antes de armazená-la
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Preparar a consulta para inserir os dados no banco de dados
    $sql = "INSERT INTO usuario (login, senha) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $login, $senha_hash);  // "ss" significa que ambos são strings
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o usuário.";
    }

    // Fechar a conexão
    $stmt->close();
    $mysqli->close();
}
?>
