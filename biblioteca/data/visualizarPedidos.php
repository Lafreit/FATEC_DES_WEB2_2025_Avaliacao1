<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] != "bibliotecario") {
    header("Location: ../script/dashboard.php");
    exit;
}

echo "<h1>Pedidos Cadastrados</h1>";

$filepath = "../data/pedidos.txt";

if (!file_exists($filepath)) {
    echo "<p style='color: red;'>Erro: o arquivo de pedidos não foi encontrado.</p>";
    exit;
}

if (!is_readable($filepath)) {
    echo "<p style='color: red;'>Erro: o arquivo de pedidos não pode ser lido. Verifique as permissões.</p>";
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
                echo "<p style='color: red;'>Dados incompletos ou mal formatados: $linha</p>";
            }
        }
    }
    fclose($arquivo);
} else {
    echo "<p style='color: red;'>Erro ao abrir o arquivo de pedidos. Verifique se ele existe e tem as permissões corretas.</p>";
}

echo '<a href="../script/dashboard.php">Voltar ao Painel</a>';
?>
