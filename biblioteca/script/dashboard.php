<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['usuario']) || !in_array($_SESSION['usuario'], ["bibliotecario", "professor"])) {
    header("Location: /biblioteca/index.php");
    exit;
}

$usuario = htmlspecialchars($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Biblioteca</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo ucfirst($usuario); ?>!</h1>

    <?php if ($usuario == "bibliotecario"): ?>
        <a href="/biblioteca/script/cadastrarLivro.php">Cadastrar Livros</a><br>
        <a href="/biblioteca/data/visualizarPedidos.php">Visualizar Pedidos</a><br>
    <?php elseif ($usuario == "professor"): ?>
        <a href="/biblioteca/script/cadastrarPedido.php">Cadastrar Pedido</a><br>
    <?php endif; ?>

    <a href="/biblioteca/data/visualizarLivros.php">Visualizar Livros</a><br>
    <a href="/biblioteca/script/logout.php">Sair</a>
</body>
</html>
