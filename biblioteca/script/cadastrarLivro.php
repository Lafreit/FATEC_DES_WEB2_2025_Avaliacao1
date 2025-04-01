<?php
session_start();

// Configuração de erros para depuração
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificação de sessão
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] != "bibliotecario") {
    header("Location: /biblioteca/script/dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = htmlspecialchars($_POST['titulo']);
    $autor = htmlspecialchars($_POST['autor']);
    $editora = htmlspecialchars($_POST['editora']);
    $isbn = htmlspecialchars($_POST['isbn']);
    $dados = "$titulo | $autor | $editora | $isbn\n";

    // Caminho do arquivo
    $caminhoArquivo = __DIR__ . "/livros.txt";

    if (file_put_contents($caminhoArquivo, $dados, FILE_APPEND | LOCK_EX)) {
        echo "<p style='color: green;'>Livro cadastrado com sucesso!</p>";
    } else {
        echo "<p style='color: red;'>Erro ao salvar o livro.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Livro</title>
</head>
<body>
    <h1>Cadastrar Livro</h1>
    <form method="POST">
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
