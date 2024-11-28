<?php
session_start();

// Definindo as constantes para conexão com o banco de dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'fc');

// Conectar ao banco de dados
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Verificar se ocorreu erro na conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe o login e a senha do formulário
    $login = htmlspecialchars(trim($_POST['login']));
    $senha = trim($_POST['senha']);

    // Validar se os campos não estão vazios
    if (empty($login) || empty($senha)) {
        $_SESSION['login_error'] = "Preencha todos os campos.";
        header('Location: index.php');
        exit();
    }

    // Preparar a consulta para buscar o usuário no banco de dados
    $sql = "SELECT * FROM usuario WHERE login = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $login); // "s" para string
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verificar a senha criptografada
        if (password_verify($senha, $user['senha'])) {
            // Senha correta, iniciar a sessão
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_login'] = $user['login'];
            $_SESSION['welcome_message'] = 'Bem-vindo à página administrativa!'; // Armazenar a mensagem
            header('Location: adm/home.php'); // Redirecionar para home
            // Código da página de administração (home.php)
            
            exit();
        } else {
            // Senha incorreta
            $_SESSION['login_error'] = "Login ou senha incorretos!";
            sleep(1); // Adiciona atraso para evitar força bruta
            header('Location: index.php'); 
            exit();
        }
    } else {
        // Usuário não encontrado
        $_SESSION['login_error'] = "Login ou senha incorretos!";
        sleep(1); // Adiciona atraso para evitar força bruta
        header('Location: index.php');
        exit();
    }

    $stmt->close();
    $mysqli->close();
}
?>
