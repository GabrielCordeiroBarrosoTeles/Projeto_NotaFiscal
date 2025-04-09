<?php
require '../includes/db.php';

if (isset($_GET['id'])) {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    function getPDOConnection() {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    
        $host = $_ENV['DB_HOST'];
        $db = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        $charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';
    
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    
        try {
            return new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
    
    if ($id) {
        $pdo = getPDOConnection();
        $stmt = $pdo->prepare("SELECT funcao FROM estoque WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $funcao = $result['funcao'];

            $stmtProdutos = $pdo->prepare("SELECT * FROM estoque WHERE funcao = :funcao ORDER BY vendido");
            $stmtProdutos->bindParam(':funcao', $funcao);
            $stmtProdutos->execute();
            $produtos = $stmtProdutos->fetchAll(PDO::FETCH_ASSOC);

            if ($produtos) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($funcao); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo moderno para scrollbar */
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
    <?php include '../includes/navbar_modal_prod.php'; ?>
    <div class="container py-5">
        <h2 class="text-center"><?php echo htmlspecialchars($funcao); ?></h2>
        <div class="row">
            <?php foreach ($produtos as $estoque): ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                    <div class="card rounded shadow-sm border-0">
                        <div class="card-body p-4">
                            <img src="./adm/img/estoque/<?php echo htmlspecialchars($estoque['imagem']); ?>" alt="" class="img-fluid d-block mx-auto mb-3">
                            <h5><a href="#" class="text-dark text-decoration-none"><?php echo htmlspecialchars($estoque['nome']); ?></a></h5>
                            <p class="small text-muted font-italic"><?php echo htmlspecialchars($estoque['funcao']); ?></p>
                            <button class="btn btn-brand ms-lg-3" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $estoque['id']; ?>">Ver Mais</button>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="myModal<?php echo $estoque['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo htmlspecialchars($estoque['nome']); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="./img/estoque/<?php echo htmlspecialchars($estoque['imagem']); ?>" alt="" class="img-fluid d-block mx-auto mb-3" style="max-width: 200px; max-height: 200px;">
                                <p>Função: <?php echo htmlspecialchars($estoque['funcao']); ?></p>
                                <p>Detalhe: <?php echo htmlspecialchars($estoque['detalhe']); ?></p>
                                <p>Valor de Venda: <?php echo htmlspecialchars($estoque['valorvenda']); ?></p>
                                <p>Marca: <?php echo htmlspecialchars($estoque['marca']); ?></p>
                                <p>Peso: <?php echo htmlspecialchars($estoque['peso']); ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
            } else {
                echo "<h5>Nenhum produto encontrado</h5>";
            }
        } else {
            echo "<h5>Nenhum produto encontrado com o ID fornecido</h5>";
        }
    } else {
        echo "<h5>Parâmetro ID inválido</h5>";
    }
} else {
    echo "<h5>Parâmetro ID não encontrado</h5>";
}
?>