<?php
session_start();

require_once '../includes/db.php'; // Arquivo de conexão com o banco de dados

function getPDOConnection() {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $host = $_ENV['DB_HOST'];
    $db = $_ENV['DB_NAME'];
    $user = $_ENV['DB_USER'];
    $pass = $_ENV['DB_PASS'];
    $charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $senha = trim($_POST['senha']);

    if (empty($login) || empty($senha)) {
        $_SESSION['login_error'] = "Preencha todos os campos.";
        header('Location: index.php');
        exit();
    }

    try {
        $pdo = getPDOConnection(); // Função para obter conexão PDO
        $stmt = $pdo->prepare("SELECT * FROM usuario WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($senha, $user['senha'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_login'] = $user['login'];
                $_SESSION['user_cargo'] = $user['cargo'];
                $_SESSION['welcome_message'] = 'Bem-vindo à página administrativa! Você é ' . $user['cargo'] . '.';

                header('Location: adm/home.php');
                exit();
            } else {
                $_SESSION['login_error'] = "Login ou senha incorretos!";
            }
        } else {
            $_SESSION['login_error'] = "Login ou senha incorretos!";
        }
    } catch (PDOException $e) {
        error_log($e->getMessage());
        $_SESSION['login_error'] = "Erro ao conectar ao banco de dados.";
    }

    sleep(1); // Adiciona atraso para evitar força bruta
    header('Location: index.php');
    exit();
}
?>

