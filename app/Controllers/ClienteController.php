<?php

class ClienteController {
    public function index() {
        $db = Database::getInstance();
        $stmt = $db->query("SELECT * FROM clientes");
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../../resources/views/clientes/index.php';
    }

    public function store() {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO clientes (nome, email) VALUES (:nome, :email)");
        $stmt->execute([
            ':nome' => $_POST['nome'],
            ':email' => $_POST['email']
        ]);

        header('Location: /clientes');
    }

    public function show($id) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            echo "Cliente: " . htmlspecialchars($cliente['nome']) . " - " . htmlspecialchars($cliente['email']);
        } else {
            http_response_code(404);
            echo "Cliente com ID {$id} não encontrado.";
        }
    }
}
