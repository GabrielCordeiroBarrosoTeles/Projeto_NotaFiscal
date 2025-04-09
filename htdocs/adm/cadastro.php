<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h2>Cadastrar Usuário</h2>
    <form action="cadastrar_usuario.php" method="post">
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" required>
        <br><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br><br>

        <label>Cargo:</label>
        <br>
        <!--
            <input type="radio" name="cargo" value="cliente" id="cliente" required>
            <label for="cliente">Cliente</label>
            <br>
        -->
        <input type="radio" name="cargo" value="operador" id="operador" required>
        <label for="operador">Operador</label>
        <br>
        <input type="radio" name="cargo" value="adm" id="adm" required>
        <label for="adm">Administrador</label>
        <br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
