<?php
    // Inclui a verificação de sessão, que deve ser o primeiro a ser chamado
    require 'session_check.php'; // Corrija o caminho caso o arquivo 'session_check.php' esteja em outro diretório

    // Inclua a conexão com o banco de dados, se necessário
    require '../dbcon.php';
?>
 


<!doctype html>
<html lang="pt-BR">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    
    <style>
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #E7DFDD;
            border-radius: 30px;
        }
        ::-webkit-scrollbar-thumb {
            background: #000000;
            border-radius: 30px;
        }
    </style>
    <title>Estoque Edit</title>
</head>
<body>
    <?php include './includes/navbar_modal.php'?> <!-- Navbar -->
    <div class="container mt-5">
        <?php include('message.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Estoque
                            <a href="exibir.php" class="btn btn-danger float-end">VOLTAR
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                            </a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if(isset($_GET['id']))
                        {
                            $estoque_id = mysqli_real_escape_string($mysqli, $_GET['id']);
                            $query = "SELECT * FROM estoque WHERE id='$estoque_id' ";
                            $query_run = mysqli_query($mysqli, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $estoque = mysqli_fetch_array($query_run);
                                $nome = $estoque['nome'];
                                if (stripos($nome, 'ração') === 0) {
                                    $v_compra = ($estoque['valorcompra'] * 1000);
                                    $v_venda = ($estoque['valorvenda'] * 1000);
                                    $qtd = ($estoque['quantidade'] / 1000);
                                }else{
                                    $v_compra = $estoque['valorcompra'];
                                    $v_venda = $estoque['valorvenda'];
                                    $qtd = $estoque['quantidade'];
                                }
                                ?>
                                <form action="code.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="estoque_id" value="<?= $estoque['id']; ?>">
                                    <div class="mb-3">
                                        <img class="form" height="250px" id="preview-imagem" src="../img/estoque/<?= $estoque['imagem']; ?>"><br>
                                        <label for="imagem_caminho" class="form-label">Caminho da imagem</label>
                                        <input type="text" name="imagem_caminho" value="<?= $estoque['imagem']; ?>" class="form-control" id="nome" oninput="updateImagemPreview(this.value)" required>
                                    </div>
                                    <p>OU</p>
                                    <div class="form-group">
                                        <label for="imagem_input">Imagem:</label>
                                        <input type="file" class="form-control" id="imagem_input" name="imagem_input">
                                    </div>
                                    <script>
                                        function updateImagemPreview(caminhoImagem) {
                                            var previewImagem = document.getElementById('preview-imagem');
                                            previewImagem.src = caminhoImagem;
                                        }
                                    </script>
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" name="nome" value="<?= $estoque['nome']; ?>" class="form-control" id="nome" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="funcao" class="form-label">funcao</label>
                                        <input type="text" name="funcao" value="<?= $estoque['funcao']; ?>" class="form-control" id="funcao" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="detalhe" class="form-label">detalhe</label>
                                        <input type="text" name="detalhe" value="<?= $estoque['detalhe']; ?>" class="form-control" id="detalhe" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="valorcompra" class="form-label">Valor de Compra</label>
                                        <input type="text" name="valorcompra" value="<?= $v_compra; ?>" class="form-control" id="preco" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="valorvenda" class="form-label">Valor de Venda</label>
                                        <input type="text" name="valorvenda" value="<?= $v_venda; ?>" class="form-control" id="preco" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantidade" class="form-label">Quantidade</label>
                                        <input type="text" name="quantidade" value="<?= $qtd; ?>" class="form-control" id="quantidade" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="marca" class="form-label">Marca</label>
                                        <input type="text" name="marca" value="<?= $estoque['marca']; ?>" class="form-control" id="marca" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="peso" class="form-label">Peso</label>
                                        <input type="text" name="peso" value="<?= $estoque['peso']; ?>" class="form-control" id="peso" required>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_estoque" class="btn btn-primary">Atualizar Estoque</button>
                                    </div>
                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>Nenhum ID encontrado</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
    $(document).ready(function () { 
        var $seuCampoCpf = $("#cpf");
        $seuCampoCpf.mask('000.000.000-00', {reverse: true});
    });
</script>
</body>
</html>