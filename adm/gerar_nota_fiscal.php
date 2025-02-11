<?php
    // Importa as configurações do site
    require '../config.php'; 

    // Inclui a verificação de sessão, que deve ser o primeiro a ser chamado
    require 'session_check.php'; // Corrija o caminho caso o arquivo 'session_check.php' esteja em outro diretório

    // Inclua a conexão com o banco de dados, se necessário
    require '../dbcon.php';

    // Verificação de cargo
    if (!isset($_SESSION['user_cargo']) || $_SESSION['user_cargo'] == 'cliente') {
        // Redirecione para uma página de erro ou exiba uma mensagem de acesso negado
        header('Location: erro_acesso.php'); // Página de erro personalizada
        exit(); // Encerra a execução do script
    }
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <title>Gerar Nota Fiscal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
</head>
<body>
    
    <?php
    if (isset($_GET['id'])) {
        // O ID está presente na URL, execute o código para recuperar as informações do cliente
        $id = $_GET['id'];
    
        // Conecte-se ao banco de dados e execute a consulta para obter as informações do cliente
        $conn = new mysqli('localhost', 'root', '', 'fc');
         
        if ($conn->connect_error) {
            die("Falha na conexão com o banco de dados: " . $conn->connect_error);
        }
    
        $sql = "SELECT nome, cpf FROM cliente WHERE id = '$id'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nomeCliente = $row['nome'];
            $cpfCliente = $row['cpf'];
        } else {
            // Cliente não encontrado com o ID fornecido
            // Lidere com essa situação de acordo com suas necessidades
            // Por exemplo, redirecione para uma página de erro ou exiba uma mensagem de erro
        }
    
        $conn->close();
    } else {
        // O ID não está presente na URL, defina as variáveis como vazias
        $nomeCliente = '';
        $cpfCliente = '';
    }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verificar se todos os campos obrigatórios estão preenchidos
            if (empty($_POST['nomeCliente']) || empty($_POST['cpfCliente']) || empty($_POST['itens'])) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    echo 'Preencha todos os campos obrigatórios.';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">';
                        echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                echo '</div>';
            } else {
                // Dados da nota fiscal
                $nomeCliente = $_POST['nomeCliente'];
                $cpfCliente = $_POST['cpfCliente'];
        
                // Verificar se o campo "valorTotal" está definido
                $valorTotal = isset($_POST['valorTotal']) ? $_POST['valorTotal'] : 0;

                // Dados da empresa
                $nomeEmpresa = $CompanyName;
                $cnpjEmpresa = $CompanyCNPJ;
                $enderecoEmpresa = $CompanyAddress;
                $telefoneEmpresa = $CompanyTelephone;

                // Itens da nota fiscal
                $itens = isset($_POST['itens']) ? $_POST['itens'] : array();
                $precos = isset($_POST['precos']) ? $_POST['precos'] : array();
                $quantidades = isset($_POST['quantidades']) ? $_POST['quantidades'] : array();
                $formaPagamento = isset($_POST['formaPagamento']) ? $_POST['formaPagamento'] : array();

                // Conectar ao banco de dados
                $conn = new mysqli('localhost', 'root', '', 'fc');

                // Verificar se a conexão foi estabelecida com sucesso
                if ($conn->connect_error) {
                    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
                }

                // Array para armazenar os valores de compra dos itens
                $valoresCompra = array();

                // Loop pelos itens
                foreach ($itens as $index => $item) {
                    // Consultar o valor de compra do item no banco de dados
                    $sql = "SELECT valorcompra FROM estoque WHERE nome = '$item'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $valorCompra = $row['valorcompra'];
                        $valoresCompra[$index] = $valorCompra;
                    } else {
                        $valoresCompra[$index] = 0;
                    }
                }

                // Fechar a conexão com o banco de dados
                $conn->close();

                // Gerar número da nota fiscal
                $numeroNota = uniqid();

                // Gerar data da nota fiscal
                $dataNota = date("Y-m-d");
                // Defina o fuso horário para Brasília
                date_default_timezone_set('America/Sao_Paulo');
                $horaNota = date("H:i");

                // Calcular impostos
                $impostoFederal = 0.10; // Substitua pelo valor real do imposto federal
                $impostoMunicipal = 0.05; // Substitua pelo valor real do imposto municipal

                // Calcular total com impostos
                $subtotalTotal = 0; // Variável para armazenar a soma dos subtotais dos itens
                $subtotalTotalLucro = 0; // Variável para armazenar a soma dos subtotais dos itens

// Loop pelos itens e quantidades
foreach ($itens as $index => $item) {
    $quantidade = isset($quantidades[$index]) ? $quantidades[$index] : '';
    $preco = isset($precos[$index]) ? $precos[$index] : '';
    $valorCompra = $valoresCompra[$index]; // Valor de compra correspondente ao item

    $subtotal = $quantidade * $preco;
    $subtotallucro = ($preco - $valorCompra) * $quantidade;

    $subtotalTotal += $subtotal; // Adiciona o subtotal atual à soma total dos subtotais
    $subtotalTotalLucro += $subtotallucro; // Adiciona o subtotal atual à soma total dos subtotais

    // Adicione o cálculo do lucro ao XML
    $xml .= '<lucro>'.$subtotallucro.'</lucro>';
}

// Mova a linha abaixo para fora do loop foreach
$subtotalTotalLucro = round($subtotalTotalLucro, 2);


// Move a linha abaixo para fora do loop foreach
$subtotalTotalLucro = round($subtotalTotalLucro, 2);


                $totalComImpostos = $subtotalTotal + $impostoFederal + $impostoMunicipal;

                // Gerar arquivo XML da nota fiscal
                $xml = '<?xml version="1.0" encoding="UTF-8"?>';
                $xml .= '<nota_fiscal>';
                $xml .= '<numero>'.$numeroNota.'</numero>';
                $xml .= '<data>'.$dataNota.'</data>';
                $xml .= '<hora>'.$horaNota.'</hora>';
                $xml .= '<cliente>';
                $xml .= '<nome>'.$nomeCliente.'</nome>';
                $xml .= '<cpf>'.$cpfCliente.'</cpf>';
                $xml .= '</cliente>';
                $xml .= '<empresa>';
                $xml .= '<nome>'.$nomeEmpresa.'</nome>';
                $xml .= '<cnpj>'.$cnpjEmpresa.'</cnpj>';
                $xml .= '<endereco>'.$enderecoEmpresa.'</endereco>';
                $xml .= '<telefone>'.$telefoneEmpresa.'</telefone>';
                $xml .= '</empresa>';
                $xml .= '<itens>';
                
                // Loop pelos itens e quantidades
foreach ($itens as $index => $item) {
    $quantidade = isset($quantidades[$index]) ? $quantidades[$index] : '';
    $preco = isset($precos[$index]) ? $precos[$index] : '';
    $valorCompra = $valoresCompra[$index]; // Valor de compra correspondente ao item

    $subtotal = $quantidade * $preco;
    $subtotallucro = ($preco - $valorCompra) * $quantidade;

    $subtotalTotal += $subtotal; // Adiciona o subtotal atual à soma total dos subtotais

    // Adicione o cálculo do lucro ao XML
    $xml .= '<item>';
    $xml .= '<nome>'.$item.'</nome>';
    if (stripos($item, 'Ração') === 0) {
        if($quantidade>=1000){
            $xml .= '<quantidade>'.($quantidade/1000).'Kg</quantidade>';
        }else{
            $xml .= '<quantidade>'.($quantidade).'g</quantidade>';
        }
        $xml .= '<valor_venda>'.($preco*1000).'p/Kg </valor_venda>';
        $xml .= '<valor_compra>'.($valorCompra*1000).'</valor_compra>'; // Adiciona o valor de compra ao XML
    }else{
        $xml .= '<quantidade>'.$quantidade.'</quantidade>';
        $xml .= '<valor_venda>'.$preco.'</valor_venda>';
        $xml .= '<valor_compra>'.$valorCompra.'</valor_compra>'; // Adiciona o valor de compra ao XML
    }
    $xml .= '<subtotal>'.$subtotal.'</subtotal>';
    $xml .= '<lucro>'.$subtotallucro.'</lucro>';
    $xml .= '</item>';

    $subtotalTotalLucro += $subtotallucro; // Adiciona o lucro atual ao lucro total
}

$subtotalTotal = round(($subtotalTotal/2), 2); // Mova esta linha para fora do loop foreach
$subtotalTotalLucro = round(($subtotalTotalLucro/2), 2); // Mova esta linha para fora do loop foreach


                $xml .= '</itens>';
                $xml .= '<valor_total>'.$subtotalTotal.'</valor_total>';
                $xml .= '<valor_total_lucro>'.$subtotalTotalLucro.'</valor_total_lucro>';
                $xml .= '<imposto_federal>'.$impostoFederal.'</imposto_federal>';
                $xml .= '<imposto_municipal>'.$impostoMunicipal.'</imposto_municipal>';
                $xml .= '<total_com_impostos>'.$totalComImpostos.'</total_com_impostos>';
                $xml .= '<forma_de_pagamento>'.$formaPagamento.'</forma_de_pagamento>';
                $xml .= '</nota_fiscal>';

                // Salvar o arquivo XML na pasta "notasfiscais"
                $nomeArquivo = 'notasfiscais/nota_fiscal_'.$numeroNota.'.xml';
                file_put_contents($nomeArquivo, $xml);

                // Exibir mensagem de sucesso
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                    echo 'Nota fiscal gerada com sucesso. Arquivo: '.$nomeArquivo;
                    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Fechar">';
                        echo '<span aria-hidden="true">&times;</span>';
                    echo '</button>';
                echo '</div>';
 
                // Atualizar a quantidade disponível no banco de dados
                $conn = new mysqli('localhost', 'root', '', 'fc');

                foreach ($itens as $index => $item) {
                    $quantidade = isset($quantidades[$index]) ? $quantidades[$index] : '';

                    // Atualizar a quantidade no banco de dados
                    $sqlUpdateQuantidade = "UPDATE estoque SET quantidade = quantidade - $quantidade WHERE nome = '$item'";
                    $conn->query($sqlUpdateQuantidade);
                }
                foreach ($itens as $index => $item) {
                    $quantidade = isset($quantidades[$index]) ? $quantidades[$index] : '';
                
                    // Atualizar a quantidade vendida no banco de dados
                    $sqlUpdateVendido = "UPDATE estoque SET vendido = vendido + $quantidade WHERE nome = '$item'";
                    $conn->query($sqlUpdateVendido);
                }
                

                $conn->close();

                // Redirecionar para index.php
                header("Location: home.php");
                exit;
            }
        }
    ?>
    <?php include './includes/navbar_modal.php'?> <!-- Navbar -->
    <div class="container">
        <h1>Gerar Nota Fiscal</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="nomeCliente">Nome do Cliente:</label>
                <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" onchange="updatePrice()" value="<?php echo $nomeCliente; ?>" required>
            </div>
            <div class="form-group">
                <label for="cpfCliente">CPF do Cliente:</label>
                <input type="text" class="form-control" id="cpfCliente" name="cpfCliente" value="<?php echo $cpfCliente; ?>" required>
            </div>
            
            <table class="table table-bordered" id="itensTable">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Preço Unitário</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            
                            <select class="form-control" name="itens[]" onchange="updatePrice(); updateQuantityLimit(this);" required>
                                <option  selected disabled value="">Selecione um item</option>
                                <?php
                                    // Conectar ao banco de dados
                                    $conn = new mysqli('localhost', 'root', '', 'fc');

                                    // Verificar se a conexão foi estabelecida com sucesso
                                    if ($conn->connect_error) {
                                        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
                                    }

                                    // Consultar os itens no estoque
                                    $sql = "SELECT id, nome, valorvenda, quantidade FROM estoque WHERE quantidade > 0";

                                    $result = $conn->query($sql);

                                    // Exibir as opções no campo de seleção
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='{$row['nome']}' data-preco='{$row['valorvenda']}' data-quantidade='{$row['quantidade']}'>{$row['nome']}</option>";
                                        }
                                    }

                                    // Fechar a conexão com o banco de dados
                                    $conn->close();
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" class="form-control" id="precoUnitario" name="precos[]" step="0.01" onchange="calculateSubtotal()" readonly>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="quantidades[]" min="1" onchange="calculateSubtotal()" required>
                        </td>
                        <td>
                            <input type="number" class="form-control" name="subtotais[]" step="0.01" readonly>
                        </td>
                    </tr>
                </tbody>
            </table>    
            <div class="form-group text-center">
                <button type="button" class="btn btn-primary" onclick="addRow()">Adicionar Item</button>
            </div>
            <div class="form-group text-center">
    <h4 style="text-align:center;">Forma de Pagamento:</h4><br>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="formaPagamento" id="formaPagamento1" value="Dinheiro" required>
        <label class="form-check-label" for="formaPagamento1">Dinheiro</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="formaPagamento" id="formaPagamento2" value="Cartao">
        <label class="form-check-label" for="formaPagamento2">Cartão de Crédito</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="formaPagamento" id="formaPagamento3" value="Cheque">
        <label class="form-check-label" for="formaPagamento3">Cheque</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="formaPagamento" id="formaPagamento4" value="Boleto">
        <label class="form-check-label" for="formaPagamento4">Boleto Bancário</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="formaPagamento" id="formaPagamento5" value="Pix">
        <label class="form-check-label" for="formaPagamento5">PIX</label>
    </div>
</div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success">Gerar Nota Fiscal</button>
            </div>  
        </form>

        <script>
            function updatePrice() {
                var selectItem = document.querySelector("select[name='itens[]']");
                var priceInput = document.querySelector("input[name='precos[]']");
                var selectedOption = selectItem.options[selectItem.selectedIndex];
                var price = selectedOption.getAttribute("data-preco");
                priceInput.value = price;
            }

            function updateQuantityLimit(selectItem) {
                var selectedOption = selectItem.options[selectItem.selectedIndex];
                var quantityInput = selectItem.closest("tr").querySelector("input[name='quantidades[]']");
                var quantityLimit = selectedOption.getAttribute("data-quantidade");
                quantityInput.max = quantityLimit;
            }

            function calculateSubtotal() {
                var quantityInputs = document.querySelectorAll("input[name='quantidades[]']");
                var priceInputs = document.querySelectorAll("input[name='precos[]']");
                var subtotalInputs = document.querySelectorAll("input[name='subtotais[]']");

                for (var i = 0; i < quantityInputs.length; i++) {
                    var quantityInput = quantityInputs[i];
                    var priceInput = priceInputs[i];
                    var subtotalInput = subtotalInputs[i];

                    var quantity = parseInt(quantityInput.value);
                    var price = parseFloat(priceInput.value);
                    var subtotal = quantity * price;

                    var availableQuantity = parseInt(quantityInput.getAttribute("max"));
                    if (quantity > availableQuantity) {
                        quantity = availableQuantity;
                        quantityInput.value = quantity;
                        alert("A quantidade máxima disponível é " + availableQuantity);
                        subtotal = quantity * price; // Atualiza o subtotal com a quantidade corrigida
                    }

                    subtotalInput.value = subtotal.toFixed(2);
                }
            }

            function addRow() {
    var tableBody = document.querySelector("#itensTable tbody");

    var selectItems = document.querySelectorAll("select[name='itens[]']");
    var selectedOptions = Array.from(selectItems).map(function (select) {
        return select.value;
    });

    // Fazer uma requisição AJAX para buscar os itens disponíveis
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_items.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var items = JSON.parse(xhr.responseText);

            var newRow = document.createElement("tr");

            // Filtra os itens disponíveis removendo aqueles com quantidade zero
            var availableItems = items.filter(function (item) {
                return item.quantidade > 0 && !selectedOptions.includes(item.nome);
            });

            // Verifica se há itens disponíveis para exibir no segundo <select>
            if (availableItems.length > 0) {
                newRow.innerHTML = `
                    <td>
                        <select class="form-control" name="itens[]" onchange="updatePrice(); updateQuantityLimit(this);" required>
                            <option value="">Selecione um item</option>
                            ${availableItems.map(function (item) {
                                return `<option value="${item.nome}" data-preco="${item.valorvenda}" data-quantidade="${item.quantidade}" onchange="updatePrice()">${item.nome}</option>`;
                            }).join("")}
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="precos[]" step="0.01" readonly>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="quantidades[]" min="1" onchange="calculateSubtotal()" required>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="subtotais[]" step="0.01" readonly>
                    </td>
                `;

                tableBody.appendChild(newRow);

                // Chama as funções para atualizar o preço e o limite de quantidade
                updatePrice();
                updateQuantityLimit(newRow.querySelector("select[name='itens[]']"));

                // Adiciona o evento de change para atualizar o preço com base no item selecionado
                var selectItem = newRow.querySelector("select[name='itens[]']");
                selectItem.addEventListener("change", function () {
                    var priceInput = this.closest("tr").querySelector("input[name='precos[]']");
                    var selectedOption = this.options[this.selectedIndex];
                    priceInput.value = selectedOption.getAttribute("data-preco");
                    calculateSubtotal();
                });
            } else {
                alert("Não há itens disponíveis.");
            }
        }
    };
    xhr.send();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
    $(document).ready(function () { 
        var $seuCampoCpf = $("#cpfCliente");
        $seuCampoCpf.mask('000.000.000-00', {reverse: true});
    });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
    $(document).ready(function () { 
        var $seuCampoCpf = $("#cpf");
        $seuCampoCpf.mask('000.000.000-00', {reverse: true});
    });
</script>
    </div>
</body>
</html> 