<?php
    // Inclui a verificação de sessão, que deve ser o primeiro a ser chamado
    require 'session_check.php'; // Corrija o caminho caso o arquivo 'session_check.php' esteja em outro diretório

    // Inclua a conexão com o banco de dados, se necessário
    require '../dbcon.php';
?>
 

 <!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Notas Fiscais</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
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
</head>
<body>
<?php include './includes/navbar_modal.php'?><!--Navbar-->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 style="text-align: center;">Notas Fiscais</h2>
                </div>
                <div class="card-body table-responsive">
                    <label for="selectMes">Mês:</label>
                    <select id="selectMes" class="form-select">
                        <option selected disabled>Selecione um mês:</option>
                        <option value="0">Todos</option>
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                    <table class="table table-bordered table-striped" id="example" style="text-align:center;">
                        <thead>
                            <tr>
                                <th>Número</th>
                                <th>Nome</th>
                                <th>Cpf</th>
                                <th>Valor Total</th>
                                <th>Lucro</th>
                                <th>F. pagamento</th>
                                <th>Data</th>
                                <th>Imprimir</th>
                                <th>Deletar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $diretorio = 'notasfiscais';
                            $arquivosNotasFiscais = glob($diretorio . '/*.xml');
                            $somaValorTotal = 0; // Variável para armazenar a soma do valor total
                            $somaLucro = 0; // Variável para armazenar a soma do lucro
                            $lucroPorDia = array(); // Array para armazenar a soma dos lucros por dia

                            foreach ($arquivosNotasFiscais as $caminhoArquivo) {
                                $xml = simplexml_load_file($caminhoArquivo);
                                $numeroNota = (string)$xml->numero;
                                $nomeCliente = (string)$xml->cliente->nome;
                                $cpfCliente = (string)$xml->cliente->cpf;
                                $dataNota = date('d/m/Y', strtotime((string)$xml->data)); // Formata a data para dd/mm/aaaa
                                $valorTotal = (float)$xml->valor_total;
                                $valorTotalformatado = str_replace('.', ',', $valorTotal);
                                $valor_venda = (float)$xml->valor_venda;
                                $valor_compra = (float)$xml->valor_compra;
                                $subtotal = (float)$xml->subtotal;
                                $valorTotal_lucro = (float)$xml->valor_total_lucro;
                                $valorTotalformatado_lucro = str_replace('.', ',', $valorTotal_lucro);
                                $forma_de_pagamento = (string)$xml->forma_de_pagamento;
                                $somaValorTotal += $valorTotal; // Adiciona o valor total atual à soma total dos valores totais
                                $somaLucro += $valorTotal_lucro; // Adiciona o lucro atual à soma total dos lucros

                                // Calcula a soma dos lucros por dia
                                $dia = date('Y-m-d', strtotime((string)$xml->data));
                                if (!isset($lucroPorDia[$dia])) {
                                    $lucroPorDia[$dia] = 0;
                                }
                                $lucroPorDia[$dia] += $valorTotal_lucro;

                                echo '<tr class="mes mes-' . date('n', strtotime((string)$xml->data)) . '">';
                                echo '<td>' . $numeroNota . '</td>';
                                echo '<td>' . $nomeCliente . '</td>';
                                echo '<td>' . $cpfCliente . '</td>';
                                echo '<td>R$ ' . $valorTotalformatado . '</td>';
                                echo '<td>R$ ' . $valorTotalformatado_lucro . '</td>';
                                echo '<td>' . $forma_de_pagamento . '</td>';
                                echo '<td>' . $dataNota . '</td>';
                                echo '<td><a href="imprimir_nota_fiscal.php?arquivo=' . urlencode($caminhoArquivo) . '" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</a></td>';
                                echo '<td><button class="btn btn-danger delete-button" data-file="' . urlencode($caminhoArquivo) . '"><i class="fa fa-trash"></i> Deletar</button></td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="alert alert-info" role="alert" >
                        Soma do Valor Total: R$<span id="somaValorTotal"><?php echo number_format($somaValorTotal, 2, ',', '.'); ?></span>
                        <br>
                        Soma do Lucro: R$ <span id="somaLucro"><?php echo number_format($somaLucro, 2, ',', '.'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal8" aria-hidden="true" style="text-align:center;">
        <button class="btn btn-warning btn-sm">Gráfico de Lucro</button>
    </a><br>
</div>

<!-- Modal Cadastro Estoque -->
<div class="modal fade" id="exampleModal8" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 style="text-align: center;">Gráfico de Lucro</h2>
                                </div>
                                <div class="card-body">
                                    <canvas id="graficoLucro"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="../js/app.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    $('#example').DataTable({
        paging: false
    });

    // Excluir nota fiscal
    $('.delete-button').click(function () {
        var file = $(this).data('file');
        if (confirm('Tem certeza que deseja excluir esta nota fiscal?')) {
            window.location.href = 'excluir_nota_fiscal.php?arquivo=' + file;
        }
    });

    // Obter todos os dados de lucro
    var profitData = getProfitData();

    // Inicializar o gráfico com todos os dados
    var chart = createGraph(profitData);

    // Evento de escuta para detectar a mudança de valor no select
    $('#selectMes').change(function () {
        var selectedMonth = $(this).val();
        filterTableByMonth(selectedMonth); // Filtra a tabela de acordo com o mês selecionado
        updateSomaValores(); // Atualiza as somas do valor total e do lucro
        
        // Atualiza os dados do gráfico
        var profitDataFiltered = getProfitDataFiltered(selectedMonth);
        updateGraph(chart, profitDataFiltered);
    });
});

// Função para obter os dados de lucro das notas fiscais
function getProfitData() {
    var profitData = [];

    <?php
    foreach ($lucroPorDia as $data => $lucro) {
    ?>
        profitData.push({ data: '<?php echo $data; ?>', lucro: <?php echo $lucro; ?> });
    <?php
    }
    ?>

    // Ordenar os dados pela data em ordem crescente
    profitData.sort(function(a, b) {
        var dateA = new Date(a.data);
        var dateB = new Date(b.data);
        return dateA - dateB;
    });

    return profitData;
}

// Função para filtrar os dados de lucro pelo mês selecionado
function getProfitDataFiltered(month) {
    if (month == 0) {
        return getProfitData();
    } else {
        return getProfitData().filter(function(data) {
            var date = new Date(data.data);
            return date.getMonth() + 1 == month; // "+ 1" porque getMonth() retorna valores de 0 a 11
        });
    }
}

// Função para filtrar a tabela de notas fiscais pelo mês selecionado
function filterTableByMonth(month) {
    var tableRows = $('#example tbody tr');
    tableRows.show(); // Exibir todas as linhas

    if (month != 0) {
        tableRows.each(function () {
            var date = $(this).find('td:nth-child(7)').text(); // Obter a data da coluna "Data"
            var rowMonth = parseInt(date.split('/')[1]); // Extrair o mês da data
            if (rowMonth != month) {
                $(this).hide(); // Esconder as linhas que não correspondem ao mês selecionado
            }
        });
    }
}

// Função para criar o gráfico de lucro
function createGraph(lucroData) {
    var dataLabels = [];
    var lucroValues = [];

    for (var i = 0; i < lucroData.length; i++) {
        var formattedDate = moment(lucroData[i].data).format('DD/MM/YYYY');
        dataLabels.push(formattedDate);
        lucroValues.push(lucroData[i].lucro);
    }

    var ctx = document.getElementById('graficoLucro').getContext('2d');
    var graficoLucro = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dataLabels,
            datasets: [{
                label: 'Lucro',
                data: lucroValues,
                backgroundColor: 'rgba(0, 123, 255, 0.4)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            return 'R$ ' + value.toFixed(2);
                        }
                    }
                }
            }
        }
    });

    return graficoLucro;
}

// Função para atualizar os dados do gráfico
function updateGraph(chart, lucroData) {
    var dataLabels = [];
    var lucroValues = [];

    for (var i = 0; i < lucroData.length; i++) {
        var formattedDate = moment(lucroData[i].data).format('DD/MM/YYYY');
        dataLabels.push(formattedDate);
        lucroValues.push(lucroData[i].lucro);
    }

    chart.data.labels = dataLabels;
    chart.data.datasets[0].data = lucroValues;
    chart.update();
}

// Função para atualizar as somas do valor total e do lucro
function updateSomaValores() {
    var somaValorTotal = 0;
    var somaLucro = 0;

    $('.mes:visible').each(function () {
        var valorTotal = parseFloat($(this).find('td:nth-child(4)').text().replace('R$ ', '').replace(',', '.'));
        var lucro = parseFloat($(this).find('td:nth-child(5)').text().replace('R$ ', '').replace(',', '.'));

        somaValorTotal += valorTotal;
        somaLucro += lucro;
    });

    $('#somaValorTotal').text(somaValorTotal.toFixed(2).replace('.', ','));
    $('#somaLucro').text(somaLucro.toFixed(2).replace('.', ','));
}
</script>
</body>
</html>
