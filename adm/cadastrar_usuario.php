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
    // Recebe os dados do formulário
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $cargo = $_POST['cargo']; // Captura o valor do checkbox

    // Validar se os campos não estão vazios
    if (empty($login) || empty($senha) || empty($cargo)) {
        echo "Preencha todos os campos.";
        exit();
    }

    // Criptografar a senha antes de armazená-la
    $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

    // Preparar a consulta para inserir os dados no banco de dados
    $sql = "INSERT INTO usuario (login, senha, cargo) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sss", $login, $senha_hash, $cargo); // "sss" indica 3 strings
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Usuário cadastrado com sucesso!";
        // Aguarda 3 segundos e redireciona para o home.php
        header("refresh:3;url=home.php");
    } else {
        echo "Erro ao cadastrar o usuário.";
        // Aguarda 3 segundos e redireciona para o home.php
        header("refresh:3;url=home.php");
    }

    // Fechar a conexão
    $stmt->close();
    $mysqli->close();
}
?>
