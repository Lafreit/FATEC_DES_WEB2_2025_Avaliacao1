<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['usuario']) || !in_array($_SESSION['usuario'], ["bibliotecario", "professor"])) {
    header("Location: ../index.php");
    exit;
}

echo "<h1>Livros Cadastrados</h1>";

$filepath = "../data/livros.txt";

// Verifica se o arquivo existe e cria caso não exista
if (!file_exists($filepath)) {
    $arquivo = fopen($filepath, "w");
    if ($arquivo) {
        fclose($arquivo);
        echo "<p style='color: green;'>Arquivo de livros criado com sucesso.</p>";
    } else {
        echo "<p style='color: red;'>Erro: não foi possível criar o arquivo de livros.</p>";
        exit;
    }
}

// Verifica se o arquivo é legível
if (!is_readable($filepath)) {
    echo "<p style='color: red;'>Erro: o arquivo de livros não pode ser lido. Verifique as permissões.</p>";
    exit;
}

$arquivo = fopen($filepath, "r");
if ($arquivo) {
    while (($linha = fgets($arquivo)) !== false) {
        if (!empty($linha)) {
            $dados = explode("|", $linha);
            if (count($dados) === 4) {
                echo "<p><strong>Título:</strong> " . htmlspecialchars(trim($dados[0])) . "<br>";
                echo "<strong>Autor:</strong> " . htmlspecialchars(trim($dados[1])) . "<br>";
                echo "<strong>Editora:</strong> " . htmlspecialchars(trim($dados[2])) . "<br>";
                echo "<strong>ISBN:</strong> " . htmlspecialchars(trim($dados[3])) . "</p>";
            } else {
                echo "<p style='color: red;'>Dados incompletos ou mal formatados na linha: $linha</p>";
            }
        }
    }
    fclose($arquivo);
} else {
    echo "<p style='color: red;'>Erro ao abrir o arquivo de livros. Verifique se ele existe e tem as permissões corretas.</p>";
}

echo '<a href="../script/dashboard.php">Voltar ao Painel</a>';
?>
