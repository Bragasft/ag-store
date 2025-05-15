<?php
session_start();

// Defina as credenciais do administrador
$admin_username = "admin";  // Nome de usuário
$admin_password = "senha123";  // Senha

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os dados do formulário
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Valida se o nome de usuário e a senha estão corretos
    if ($username === $admin_username && $password === $admin_password) {
        // Cria uma sessão para o administrador
        $_SESSION['admin'] = true;
        // Redireciona para a página de administração
        header("Location: admin-dashboard.php");
        exit;
    } else {
        // Mensagem de erro em caso de falha na autenticação
        $erro = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #5C6BC0, #3949ab);
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }

        label {
            font-size: 15px;
            color: #555;
            margin-bottom: 6px;
            display: block;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input:focus {
            border-color: #5C6BC0;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #5C6BC0;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #3f51b5;
        }

        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #5C6BC0;
            display: block;
            margin-top: 15px;
            text-align: center;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login Administrador</h1>
        
        <!-- Mensagem de erro, caso o login falhe -->
        <?php if (isset($erro)): ?>
            <p class="error"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form action="admin-login.php" method="POST">
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
