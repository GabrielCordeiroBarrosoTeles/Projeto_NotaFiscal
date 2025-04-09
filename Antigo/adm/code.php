<?php
    session_start();
    require '../dbcon.php';

// Conexão com o banco de dados (substitua com suas próprias informações de conexão)
$mysqli = new mysqli('localhost',"root","","fc");

if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

if (isset($_POST['delete_estoque'])) {
    $estoque_id = mysqli_real_escape_string($mysqli, $_POST['delete_estoque']);
    $query = "DELETE FROM estoque WHERE id='$estoque_id' ";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['message'] = "produto excluído com sucesso";
        header("Location: exibir.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Não foi possível excluir o produto";
        header("Location: exibir.php");
        exit(0);
    }
}

function validar_valor($valor) {
    return floatval(str_replace(',', '.', $valor));
}

if (isset($_POST['update_estoque'])) {
    $estoque_id = mysqli_real_escape_string($mysqli, $_POST['estoque_id']);
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $funcao = mysqli_real_escape_string($mysqli, $_POST['funcao']);
    $detalhe = mysqli_real_escape_string($mysqli, $_POST['detalhe']);
    $marca = mysqli_real_escape_string($mysqli, $_POST['marca']);
    $peso = mysqli_real_escape_string($mysqli, $_POST['peso']);

    if (stripos($funcao, 'Ração') === 0) {
        $valorcompra = validar_valor($_POST['valorcompra']) / 1000;
        $valorvenda = validar_valor($_POST['valorvenda']) / 1000;
        $quantidade = validar_valor($_POST['quantidade']) * 1000;
    } else {
        $valorcompra = validar_valor($_POST['valorcompra']);
        $valorvenda = validar_valor($_POST['valorvenda']);
        $quantidade = validar_valor($_POST['quantidade']);
    }

    if (!empty($_FILES['imagem_input']['name'])) {
        $imagem_input = basename($_FILES['imagem_input']['name']);
        $imagem_temp_input = $_FILES['imagem_input']['tmp_name'];
        $imagem_destination_input = 'img/estoque/' . $imagem_input;

        if (!move_uploaded_file($imagem_temp_input, $imagem_destination_input)) {
            die("Erro ao mover o arquivo de imagem.");
        }

        $stmt = $mysqli->prepare("UPDATE estoque SET imagem=?, nome=?, funcao=?, detalhe=?, valorcompra=?, valorvenda=?, quantidade=?, marca=?, peso=? WHERE id=?");
        $stmt->bind_param("ssssdddsdi", $imagem_input, $nome, $funcao, $detalhe, $valorcompra, $valorvenda, $quantidade, $marca, $peso, $estoque_id);
    } else {
        $stmt = $mysqli->prepare("UPDATE estoque SET nome=?, funcao=?, detalhe=?, valorcompra=?, valorvenda=?, quantidade=?, marca=?, peso=? WHERE id=?");
        $stmt->bind_param("ssssddsdi", $nome, $funcao, $detalhe, $valorcompra, $valorvenda, $quantidade, $marca, $peso, $estoque_id);
    }

    if (!$stmt->execute()) {
        die("Erro ao atualizar o estoque: " . $stmt->error);
    }
    $stmt->close();
}

if (isset($_POST['save_estoque'])) {
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);  
    $funcao = mysqli_real_escape_string($mysqli, $_POST['funcao']);
    $detalhe = mysqli_real_escape_string($mysqli, $_POST['detalhe']);
    if (stripos($funcao, 'Ração') === 0) {
        // Para produtos de ração, converte valores para gramas
        $valorcompra = validar_valor($_POST['valorcompra']) / 1000;
        $valorvenda = validar_valor($_POST['valorvenda']) / 1000;
        $quantidade = validar_valor($_POST['quantidade']) * 1000;
    } else {
        // Para outros produtos, utiliza os valores diretamente
        $valorcompra = validar_valor($_POST['valorcompra']);
        $valorvenda = validar_valor($_POST['valorvenda']);
        $quantidade = validar_valor($_POST['quantidade']);
    } 
    $marca = mysqli_real_escape_string($mysqli, $_POST['marca']);
    $peso = mysqli_real_escape_string($mysqli, $_POST['peso']);

    // Processar o upload da foto
    $imagem = basename($_FILES['imagem']['name']);
    $imagem_temp = $_FILES['imagem']['tmp_name'];
    $imagem_destination = 'img/estoque/' . $imagem;
    if (!move_uploaded_file($imagem_temp, $imagem_destination)) {
        $_SESSION['message'] = "Falha ao mover o arquivo de imagem";
        header("Location: home.php");
        exit(0);
    }

    $query = "INSERT INTO estoque (nome, funcao, detalhe, valorcompra, valorvenda, quantidade, marca, peso, imagem) VALUES ('$nome', '$funcao', '$detalhe', '$valorcompra', '$valorvenda', '$quantidade', '$marca', '$peso', '$imagem')";

    $query_run = mysqli_query($mysqli, $query);
    if ($query_run) {
        $_SESSION['message'] = "Produto cadastrado com sucesso!";
        header("Location: home.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Falha ao cadastrar o produto";
        header("Location: home.php");
        exit(0);
    }
}

if(isset($_POST['save_cliente'])) {
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $cpf = mysqli_real_escape_string($mysqli, $_POST['cpf']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $telefone = mysqli_real_escape_string($mysqli, $_POST['telefone']);
    
    $query = "INSERT INTO cliente (nome,cpf,email,telefone) VALUES ('$nome','$cpf','$email','$telefone')";
    $query_run = mysqli_query($mysqli, $query);
    if($query_run) {
        $_SESSION['message'] = "cliente cadastrado com sucesso!";
        header("Location: exibir_cliente.php");
        exit(0);
    } else {
        $_SESSION['message'] = "cliente não cadastrado";
        header("Location: exibir_cliente.php");
        exit(0);
    }
}

if (isset($_POST['delete_cliente'])) {
    $student_id = mysqli_real_escape_string($mysqli, $_POST['delete_cliente']);
    $query = "DELETE FROM cliente WHERE id='$student_id' ";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['message'] = "cliente excluído com sucesso";
        header("Location: exibir_cliente.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Não foi possível excluir o cliente";
        header("Location: exibir_cliente.php");
        exit(0);
    }
}

if (isset($_POST['update_cliente'])) {
    $student_id = mysqli_real_escape_string($mysqli, $_POST['student_id']);
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $cpf = mysqli_real_escape_string($mysqli, $_POST['cpf']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $telefone = mysqli_real_escape_string($mysqli, $_POST['telefone']);

    $query = "UPDATE cliente SET nome='$nome', cpf='$cpf', email='$email', telefone='$telefone' WHERE id='$student_id' ";
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['message'] = "cliente atualizado com sucesso";
        header("Location: home.php");
        exit(0);
    } else {
        $_SESSION['message'] = "cliente não atualizado";
        header("Location: home.php");
        exit(0);
    }
}
?>
