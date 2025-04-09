<style>
    #card{
        border-radius: 0%;
        text-align: center;
        border-left: none;
        border-top: none;
        border-right: none;
        border-bottom: 6px solid #8B4513;
    }#cardtext{
        color: #747474;
        margin-top:-10px;
    }.modal-image {
        max-width: 50px; 
        max-height: 50px; 
    }
</style>
<!-- Arquivos CSS do Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Arquivos JavaScript do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php
    require 'dbcon.php';
    $funcao = "Anti-Inflamatórios";
    $query = "SELECT * FROM estoque WHERE funcao = '$funcao' ORDER BY vendido DESC LIMIT 4";
    $query_run = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($query_run) > 0) {

        echo '<div class="container py-5">';
            echo "<h2 style='text-align:center;'>" . $funcao . " Mais vendidos</h2>";
            echo '<div class="row">';

                while ($estoque = mysqli_fetch_assoc($query_run)) {
                    echo '<div class="col-lg-3 col-md-6 col-sm-6 col-6">';
                        echo '<div class="card rounded shadow-sm border-0">';
                            echo '<div class="card-body p-4">';
                                echo '<img src="./adm/img/estoque/'.$estoque["imagem"].'" alt="" class="img-fluid d-block mx-auto mb-3">';
                                echo '<h5><a href="#" class="text-dark text-center" style="text-decoration: none;">' . $estoque["nome"] . '</a></h5>';
                                echo '<p class="small text-muted font-italic text-center">' . $estoque["funcao"] . '</p>';
                                echo '<h5 class="card-title text-center">';
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
                                    echo '<img src="./adm/img/estoque/'.$estoque["imagem"].'" alt="" class="img-fluid d-block mx-auto mb-3" style="max-width: 200px; max-height: 200px;">';
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
?>
<?php
    require 'dbcon.php';
    $funcao = "Suplementos e Vitaminas";
    $query = "SELECT * FROM estoque WHERE funcao = '$funcao' ORDER BY vendido DESC LIMIT 4";
    $query_run = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($query_run) > 0) {

        echo '<div class="container py-5">';
            echo "<h2 style='text-align:center;'>" . $funcao . " Mais vendidos</h2>";
            echo '<div class="row">';

                while ($estoque = mysqli_fetch_assoc($query_run)) {
                    echo '<div class="col-lg-3 col-md-6 col-sm-6 col-6">';
                        echo '<div class="card rounded shadow-sm border-0">';
                            echo '<div class="card-body p-4">';
                                echo '<img src="./adm/img/estoque/'.$estoque["imagem"].'" alt="" class="img-fluid d-block mx-auto mb-3">';
                                echo '<h5><a href="#" class="text-dark text-center" style="text-decoration: none;">' . $estoque["nome"] . '</a></h5>';
                                echo '<p class="small text-muted font-italic text-center">' . $estoque["funcao"] . '</p>';
                                echo '<h5 class="card-title text-center">';
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
                                    echo '<img src="./adm/img/estoque/'.$estoque["imagem"].'" alt="" class="img-fluid d-block mx-auto mb-3" style="max-width: 200px; max-height: 200px;">';
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
?>
<?php
    require 'dbcon.php';
    $funcao = "Antimicrobianos";
    $query = "SELECT * FROM estoque WHERE funcao = '$funcao' ORDER BY vendido DESC LIMIT 4";
    $query_run = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($query_run) > 0) {

        echo '<div class="container py-5">';
            echo "<h2 style='text-align:center;'>" . $funcao . " Mais vendidos</h2>";
            echo '<div class="row">';

                while ($estoque = mysqli_fetch_assoc($query_run)) {
                    echo '<div class="col-lg-3 col-md-6 col-sm-6 col-6">';
                        echo '<div class="card rounded shadow-sm border-0">';
                            echo '<div class="card-body p-4">';
                                echo '<img src="./adm/img/estoque/'.$estoque["imagem"].'" alt="" class="img-fluid d-block mx-auto mb-3">';
                                echo '<h5><a href="#" class="text-dark text-center" style="text-decoration: none;">' . $estoque["nome"] . '</a></h5>';
                                echo '<p class="small text-muted font-italic text-center">' . $estoque["funcao"] . '</p>';
                                echo '<h5 class="card- text-center">';
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
                                    echo '<img src="./adm/img/estoque/'.$estoque["imagem"].'" alt="" class="img-fluid d-block mx-auto mb-3" style="max-width: 200px; max-height: 200px;">';
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
?>