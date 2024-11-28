<style>
    #card{
        align-items: center;
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
    /* Ajustes de estilo para imagens nos cards */
.card-img-top {
    width: 100%;
    height: auto;
    object-fit: cover; /* Isso vai garantir que a imagem seja coberta sem distorcer */
}

.card-body {
    padding: 1.25rem; /* Ajuste para garantir uma boa aparência */
}

.modal-image {
    width: 100%;
    max-width: 200px;
    height: auto;
    margin: 0 auto;
}


</style>
<!-- Arquivos CSS do Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- Arquivos JavaScript do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<section class="container">
    <h3  style="text-align: center;" id="eventos">Possibilidades</h3><br>
    <div class="row row-cols-3 row-cols-md-6 g-6">

        <div class="col">
            <div class="card" id="card">
                <img src="img/cadastro estoque.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><span data-bs-toggle="modal" data-bs-target="#exampleModal1"  style="background-color: #8B4513;border: #8B4513" class="btn btn-brand ms-lg-3 text-light">Cad.Estoque</span></h5>
                    <p class="card-text" id="cardtext"></p>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card" id="card">
                <img src="img/cadastro cliente.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><span data-bs-toggle="modal" data-bs-target="#exampleModal2"  style="background-color: #8B4513;border: #8B4513" class="btn btn-brand ms-lg-3 text-light">Cad.Cliente</span></h5>
                    <p class="card-text" id="cardtext"></p>
                </div>
            </div>
        </div>
               
        <div class="col">
            <div class="card" id="card">
                <img src="img/gerar nota fiscal.png" class="card-img-top" alt="..." >
                <div class="card-body">
                    <h5 class="card-title"><a href="gerar_nota_fiscal.php" style="background-color: #8B4513;border: #8B4513" class="btn btn-brand ms-lg-3 text-light">Ger.NF</a></h5>
                    <p class="card-text" id="cardtext"></p>
                </div>
            </div>
        </div>
                
        <div class="col">
            <div class="card"  id="card">
                <img src="img/exibir cliente.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title" ><a href="exibir_cliente.php" style="background-color: #8B4513;border: #8B4513" class="btn btn-brand ms-lg-3 text-light">Exib.Cliente</a></h5>
                    <p class="card-text" id="cardtext"></p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" id="card">
                <img src="img/exibir estoque.png" class="card-img-top" alt="..." >
                <div class="card-body">
                    <h5 class="card-title"><a href="exibir.php" style="background-color: #8B4513;border: #8B4513" class="btn btn-brand ms-lg-3 text-light">Exib.Estoque</a></h5>
                    <p class="card-text" id="cardtext"></p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card" id="card">
                <img src="img/exibir nota fiscal.png" class="card-img-top" alt="..." >
                <div class="card-body">
                    <h5 class="card-title"><a href="exibir_notasfiscais.php" style="background-color: #8B4513;border: #8B4513" class="btn btn-brand ms-lg-3 text-light">Exib.NF</a></h5>
                    <p class="card-text" id="cardtext"></p>
                </div>
            </div>
        </div>
                
    </div>
</section>

<?php
    //$funcao = "Anti-Inflamatórios";
    //$query = "SELECT * FROM estoque WHERE funcao = '$funcao' ORDER BY vendido DESC LIMIT 8";]
    $query = "SELECT * FROM estoque ORDER BY vendido DESC LIMIT 8";
    $query_run = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($query_run) > 0) {

        echo '<div class="container py-5">';
            //echo "<h2 style='text-align:center;'>" . $funcao . " Mais vendidos</h2>";
            echo "<h2 style='text-align:center;'> Mais vendidos</h2>";
            echo '<div class="row">';

                while ($estoque = mysqli_fetch_assoc($query_run)) {
                    echo '<div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-4">';  // Adiciona margem inferior
                        echo '<div class="card rounded shadow-sm border-0">';
                            echo '<div class="card-body p-4">';
                                echo '<img src="../img/estoque/'.$estoque["imagem"].'" alt="" class="img-fluid d-block mx-auto mb-3" style="max-width: 100%; height: auto;">';
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
                                    echo '<img src="../img/estoque/teste.webp" alt="" class="img-fluid d-block mx-auto mb-3" style="max-width: 200px; max-height: 200px; height: auto;">';
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
                </div>
            </div>
        </div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

