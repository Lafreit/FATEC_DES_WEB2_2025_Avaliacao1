<?php
session_start();
if ($_SESSION['usuario'] != "bibliotecario") {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $isbn = $_POST['isbn'];

    $dados = "$titulo | $autor | $editora | $isbn\n";

    $arquivo = fopen("livros.txt", "a");
    if ($arquivo) {
        fwrite($arquivo, $dados);
        fclose($arquivo);
        echo "Livro cadastrado com sucesso!";
    } else {
        echo "Erro ao salvar o livro.";
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
    <a href="biblioteca/script/dashboard.php">Voltar ao Painel</a>
</body>
</html>
