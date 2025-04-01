<?php
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Validação de login e senha
    if ($login === "professor" && $senha === "professor") {
        $_SESSION['usuario'] = "professor";
        header("Location: /biblioteca/script/dashboard.php");
        exit;
    } elseif ($login === "biblio" && $senha === "biblio") {
        $_SESSION['usuario'] = "bibliotecario";
        header("Location: /biblioteca/script/dashboard.php");
        exit;
    } else {
        $erro = "Credenciais inválidas! Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca</title>
    <link rel="stylesheet" href="/biblioteca/css/styles.css">
</head>
<body>
    <h1>Área de Login</h1>
    <form method="POST" action="">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
</body>
</html>
