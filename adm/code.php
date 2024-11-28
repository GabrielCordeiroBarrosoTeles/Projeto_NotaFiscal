<?php
    session_start();
    require '../dbcon.php';

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



// Conexão com o banco de dados (substitua com suas próprias informações de conexão)
$mysqli = new mysqli('localhost',"root","","fc");

if ($mysqli->connect_error) {
    die("Erro na conexão com o banco de dados: " . $mysqli->connect_error);
}

if (isset($_POST['update_estoque'])) {
    $estoque_id = mysqli_real_escape_string($mysqli, $_POST['estoque_id']);
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    if (stripos($nome, 'ração') === 0) {
        $valorcompra = (mysqli_real_escape_string($mysqli, $_POST['valorcompra']) / 1000);
        $valorvenda = (mysqli_real_escape_string($mysqli, $_POST['valorvenda']) / 1000);
        $quantidade = (mysqli_real_escape_string($mysqli, $_POST['quantidade']) * 1000);
    } else {
        $valorcompra = mysqli_real_escape_string($mysqli, $_POST['valorcompra']);
        $valorvenda = mysqli_real_escape_string($mysqli, $_POST['valorvenda']);
        $quantidade = mysqli_real_escape_string($mysqli, $_POST['quantidade']);
    }
    $funcao = mysqli_real_escape_string($mysqli, $_POST['funcao']);
    $detalhe = mysqli_real_escape_string($mysqli, $_POST['detalhe']);
    $marca = mysqli_real_escape_string($mysqli, $_POST['marca']);
    $peso = mysqli_real_escape_string($mysqli, $_POST['peso']);

    // Verifica se um novo arquivo de imagem foi enviado
    if (!empty($_FILES['imagem_input']['name'])) {
        $imagem_input = $_FILES['imagem_input']['name'];
        $imagem_temp_input = $_FILES['imagem_input']['tmp_name'];
        $imagem_destination_input = 'img/estoque/' . $imagem_input;

        // Move a imagem para a pasta de destino
        move_uploaded_file($imagem_temp_input, $imagem_destination_input);

        // Atualiza o caminho da imagem no banco de dados
        $query = "UPDATE estoque SET imagem='$imagem_destination_input', nome='$nome', funcao='$funcao', detalhe='$detalhe', marca='$marca', peso='$peso' WHERE id='$estoque_id'";
    } else {
        // Se nenhum novo arquivo de imagem foi enviado, atualiza apenas os outros campos
        $imagem_caminho = mysqli_real_escape_string($mysqli, $_POST['imagem_caminho']);
        $query = "UPDATE estoque SET nome='$nome', funcao='$funcao', detalhe='$detalhe', imagem='$imagem_caminho', marca='$marca', peso='$peso' WHERE id='$estoque_id'";
    }

    // Executa a consulta SQL
    $query_run = mysqli_query($mysqli, $query);

    if ($query_run) {
        $_SESSION['message'] = "Produto atualizado com sucesso";
        header("Location: home.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Produto não atualizado";
        header("Location: home.php");
        exit(0);
    }
}




if (isset($_POST['save_estoque'])) {
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);  
    $funcao = mysqli_real_escape_string($mysqli, $_POST['funcao']);
    $detalhe = mysqli_real_escape_string($mysqli, $_POST['detalhe']);
    $valorcompra = mysqli_real_escape_string($mysqli, $_POST['valorcompra']);
    if (stripos($nome, 'ração') === 0) {
        $valorcompra = (mysqli_real_escape_string($mysqli, $_POST['valorcompra'])/1000);
        $valorvenda = (mysqli_real_escape_string($mysqli, $_POST['valorvenda'])/1000);
        $quantidade = (mysqli_real_escape_string($mysqli, $_POST['quantidade'])*1000);
    }else{
        $valorcompra = mysqli_real_escape_string($mysqli, $_POST['valorcompra']);
        $valorvenda = mysqli_real_escape_string($mysqli, $_POST['valorvenda']);
        $quantidade = mysqli_real_escape_string($mysqli, $_POST['quantidade']);
    } 
    
    $marca = mysqli_real_escape_string($mysqli, $_POST['marca']);
    $peso = mysqli_real_escape_string($mysqli, $_POST['peso']);

    // Processar o upload da foto
    $imagem = $_FILES['imagem']['name'];
    $imagem_temp = $_FILES['imagem']['tmp_name'];
    $imagem_destination = 'img/estoque/' . $imagem;
    move_uploaded_file($imagem_temp, $imagem_destination);

    $query = "INSERT INTO estoque (nome,funcao,detalhe, valorcompra,valorvenda, quantidade, marca, peso, imagem) VALUES ('$nome','$funcao','$detalhe','$valorcompra','$valorvenda', '$quantidade', '$marca', '$peso', '$imagem_destination')";

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


if(isset($_POST['save_cliente']))
{
    $nome = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $cpf = mysqli_real_escape_string($mysqli, $_POST['cpf']);
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $telefone = mysqli_real_escape_string($mysqli, $_POST['telefone']);
    
    $query = "INSERT INTO cliente (nome,cpf,email,telefone) VALUES ('$nome','$cpf','$email','$telefone')";

    $query_run = mysqli_query($mysqli, $query);
    if($query_run)
    {
        $_SESSION['message'] = "cliente cadastrado com sucesso!";
        header("Location: exibir_cliente.php");
        exit(0);
    }
    else
    {
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
        header("Location: exibir.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Não foi possível excluir o cliente";
        header("Location: exibir.php");
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
