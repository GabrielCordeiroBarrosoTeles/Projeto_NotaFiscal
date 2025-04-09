<?php
// Conectar ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'fc');

// Verificar se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consultar os itens no estoque
$sql = "SELECT id, nome, valorcompra,valorvenda, quantidade FROM estoque";
$result = $conn->query($sql);

$items = array();

// Verificar se há itens no estoque
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $items[] = array(
            'id' => $row['id'],
            'nome' => $row['nome'],
            'prevalorcompraco' => $row['valorcompra'],
            'valorvenda' => $row['valorvenda'],
            'quantidade' => $row['quantidade']
        );
    }
}

// Fechar a conexão com o banco de dados
$conn->close();

// Retornar os itens como JSON
header('Content-Type: application/json');
echo json_encode($items);
?>
