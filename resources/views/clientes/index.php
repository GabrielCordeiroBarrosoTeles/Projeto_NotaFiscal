<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <ul>
        <?php foreach ($clientes as $cliente): ?>
            <li><?= htmlspecialchars($cliente['nome']) ?> - <?= htmlspecialchars($cliente['email']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
