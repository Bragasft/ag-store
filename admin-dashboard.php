<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        .menu-lateral {
            width: 200px;
            background-color:rgb(21, 21, 21);
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            height: 100%;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .menu-lateral a {
            text-decoration: none;
            color: white;
            margin-bottom: 20px;
            font-size: 18px;
            padding: 10px;
            border-radius: 4px;
            width: 100%;
            text-align: center;
            background-color:rgb(86, 86, 86);
        }

        .menu-lateral a:hover {
            background-color: #3949ab;
        }

        .conteudo-principal {
            flex: 1;
            padding: 40px;
            background-color: #fff;
            margin-left: 220px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
        }

        .espaco-livre {
            background-color: #f4f4f4;
            border: 1px solid #ccc;
            margin-top: 20px;
            flex: 1;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            color: #888;
        }

        .button {
            width: 100%;
            padding: 14px;
            margin: 10px 0;
            background-color: #5C6BC0;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .button:hover {
            background-color: #3f51b5;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .menu-lateral .AG-STORE{
            font-size: 42px;         /* muda o tamanho da fonte */
            color; #532             /* cor da fonte */
            font-weight: bold;       /* deixa mais "forte" */
            font-family: 'Segoe UI', sans-serif; /* fonte mais elegante */
            text-align: center;      /* centraliza o texto */
            margin-bottom: 20px;     /* espaço abaixo do título */
            text-shadow: 1px 1px 2px rgb(78, 63, 63); /* sombra leve */
        }
    </style>
</head>
<body>

    <div class="menu-lateral">
        <h3 class="AG-STORE">AG STORE</h3>
        <a href="editar-produto.php" class="button">Editar Produtos</a>
        <a href="adicionar-produto.php" class="button">Adicionar Produto</a>
        <a href="excluir-produto.php" class="button">Excluir Produto</a>
    </div>

    <div class="conteudo-principal">
        <h1>Painel Administrativo</h1>

        <div class="espaco-livre">
            <p>Espaço livre para gráficos e métricas (visitas, status dos pedidos, etc.).</p>
        </div>
    </div>

</body>
</html>
