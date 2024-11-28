<?php 
require 'dbcon.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT funcao FROM estoque WHERE id = '$id'";
    $query_run = mysqli_query($mysqli, $query);
    $result = mysqli_fetch_assoc($query_run);

    if ($result) {
        $funcao = $result['funcao'];

        $query_produtos = "SELECT * FROM estoque WHERE funcao = '$funcao' ORDER BY vendido ";
        $query_run_produtos = mysqli_query($mysqli, $query_produtos);

        if (mysqli_num_rows($query_run_produtos) > 0) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo "$funcao";?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <!-- Arquivos CSS do Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Arquivos JavaScript do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
            ::-webkit-scrollbar{
                width: 10px;
            }::-webkit-scrollbar-track{
                background: #E7DFDD;
                border-radius: 30px;
            }::-webkit-scrollbar-thumb{
                background: #000000;
                border-radius: 30px;
            }
        </style>
    </head>
    <body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="70" onload="carregar()">

        <?php include './includes/navbar_modal_prod.php'?><!--Navbar-->
        <?php include './includes/carousel.php'?><!--Carousel-->
        

        <?php
            echo '<div class="container py-5">';
            echo "<h2 style='text-align:center;'>" . $funcao . "</h2>";
            echo '<div class="row">';

            while ($estoque = mysqli_fetch_assoc($query_run_produtos)) {
                echo '<div class="col-lg-3 col-md-6 col-sm-6 col-6">';
                echo '<div class="card rounded shadow-sm border-0">';
                echo '<div class="card-body p-4">';
                echo '<img src="./img/estoque/'.$estoque["imagem"].'" alt="" class="img-fluid d-block mx-auto mb-3">';
                echo '<h5><a href="#" class="text-dark" style="text-decoration: none;">' . $estoque["nome"] . '</a></h5>';
                echo '<p class="small text-muted font-italic">' . $estoque["funcao"] . '</p>';
                echo '<h5 class="card-title">';
                echo '<span style="color:#ffff;background-color: #8B4513;border: #8B4513" class="btn btn-brand ms-lg-3" data-toggle="modal" data-target="#myModal' . $estoque["id"] . '">Ver Mais</span>';
                echo '</h5>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                // Modal
                echo '<div class="modal fade" id="myModal' . $estoque["id"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                echo '<div class="modal-dialog" role="document">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="exampleModalLabel">' . $estoque["nome"] . '</h5>';
                echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
                echo '</button>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<img src="./img/estoque/'.$estoque["imagem"].'" alt="" class="img-fluid d-block mx-auto mb-3" style="max-width: 200px; max-height: 200px;">';
                echo '<p>Função: ' . $estoque["funcao"] . '</p>';
                echo '<p>Detalhe: ' . $estoque["detalhe"] . '</p>';
                echo '<p>Valor de Venda: ' . $estoque["valorvenda"] . '</p>';
                echo '<p>Marca: ' . $estoque["marca"] . '</p>';
                echo '<p>Peso: ' . $estoque["peso"] . '</p>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';
            echo '</div>';
        } else {
            echo "<h5>Nenhum produto encontrado</h5>";
        }
    } else {
        echo "<h5>Nenhum produto encontrado com o ID fornecido</h5>";
    }
} else {
    echo "<h5>Parâmetro ID não encontrado</h5>";
}
?>
        <?php include './includes/carouselmarca.php'?><!--CarouselMarca-->

<?php include './includes/footer.php'?><!--Footer-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script>
            function carregar() {
                const dataAtual = new Date();
                const anoAtual = dataAtual.getFullYear();
                document.getElementById('anoatual').textContent = anoAtual;
            }
        </script>
        <script src="js/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/app.js"></script>
        
</body>
</html>