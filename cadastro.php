<!-- cadastro.php -->
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

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
