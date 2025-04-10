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
    <meta name="description" content="Área de login para acesso ao sistema da biblioteca.">
    <meta name="keywords" content="login, biblioteca, sistema, acesso">
    <link rel="icon" type="image/x-icon" href="icon\LAF1.png">
    <link rel="stylesheet" href="http://localhost/biblioteca/css/styles.css">
</head>
<body>
    <table class="table table-bordered table-striped table-hover">
        <tr style:"display: flex; justify-content:center; align-items: center;">
            <td style="text-align: center; background-color: #f2f2f2;">
                <img src="icon\LAF1.png" alt="Logo" style="width: 100px; height: 100px; border-radius: 50%;"><br>

            <h1>Biblioteca</h1>
            
            <p>Área de Login</p>
                      
        </tr>
        
        <tr>
            <td>
                <p>Por favor, faça login para acessar o sistema.</p>
        <form method="POST" action="">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required><br><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br><br>

            <button type="submit">Entrar</button>
    </form>
        </tr>
        <tr>
            <td>
                <p>Desenvolvido por: Luíz Antônio de Freitas</p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Versão 1.0</p>
            </td>
        </tr>
    </table>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
</body>
</html>
