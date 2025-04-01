<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] != "professor") {
    header("Location: /biblioteca/script/dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = htmlspecialchars(trim($_POST['titulo']));
    $autor = htmlspecialchars(trim($_POST['autor']));
    $editora = htmlspecialchars(trim($_POST['editora']));
    $isbn = htmlspecialchars(trim($_POST['isbn']));

    // Validação dos campos obrigatórios
    if (empty($titulo) || empty($autor) || empty($isbn)) {
        echo "<p style='color: red;'>Todos os campos obrigatórios devem ser preenchidos.</p>";
        exit;
    }

    $filepath = "../data/pedidos.txt";

    // Verifica se o arquivo existe e cria caso não exista
    if (!file_exists($filepath)) {
        $arquivo = fopen($filepath, "w");
        if ($arquivo) {
            fclose($arquivo);
        } else {
            echo "<p style='color: red;'>Erro: não foi possível criar o arquivo de pedidos.</p>";
            exit;
        }
    }

    // Verifica se o arquivo está acessível para escrita
    if (!is_writable($filepath)) {
        echo "<p style='color: red;'>Erro: o arquivo de pedidos não está acessível para escrita.</p>";
        exit;
    }

    // Abre o arquivo no modo de adição e escreve os dados
    $arquivo = fopen($filepath, "a");
    if ($arquivo) {
        fwrite($arquivo, "$titulo | $autor | $editora | $isbn\n");
        fclose($arquivo);
        echo "<p style='color: green;'>Pedido cadastrado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Erro ao salvar o pedido.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pedido</title>
</head>
<body>
    <h1>Cadastrar Pedido</h1>
    <form method="POST" action="">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required><br><br>

        <label for="editora">Editora:</label>
        <input type="text" id="editora" name="editora"><br><br>

        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
    <a href="/biblioteca/script/dashboard.php">Voltar ao Painel</a>
</body>
</html>
