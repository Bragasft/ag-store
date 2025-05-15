<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin-login.php");
    exit;
}

// Carrega os produtos do arquivo JSON
$produtos = [];
if (file_exists('produtos.json')) {
    $produtos = json_decode(file_get_contents('produtos.json'), true);
}

// Editando um produto
$editar_produto = null;
if (isset($_GET['edit']) && isset($produtos[$_GET['edit']])) {
    $editar_produto = $produtos[$_GET['edit']];
}

// Verifica se o formulário de edição foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $index = $_POST['index'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $descricao = $_POST['descricao'] ?? '';

    $imagens = [];
    for ($i = 1; $i <= 3; $i++) {
        $input = "imagem$i";
        if (isset($_FILES[$input]) && $_FILES[$input]['error'] == UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES[$input]['name'], PATHINFO_EXTENSION);
            $nomeArquivo = uniqid("img_") . "." . $ext;
            $destino = 'uploads/' . $nomeArquivo;
            move_uploaded_file($_FILES[$input]['tmp_name'], $destino);
            $imagens[] = $destino;
        } else {
            $imagens[] = $editar_produto['imagens'][$i - 1] ?? '';
        }
    }

    // Atualiza o produto no array
    if (isset($produtos[$index])) {
        $produtos[$index] = [
            "nome" => $nome,
            "preco" => $preco,
            "descricao" => $descricao,
            "imagens" => $imagens
        ];

        // Salva as alterações no arquivo JSON
        file_put_contents('produtos.json', json_encode($produtos, JSON_PRETTY_PRINT));

        // Redireciona para a página de administração após salvar
        header("Location: admin-dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
            max-width: 800px;
            text-align: center;
            margin-top: 20px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        a.button {
            text-decoration: none;
            background-color: #5C6BC0;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 18px;
            margin-bottom: 20px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        a.button:hover {
            background-color: #3949ab;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 30px;
        }

        label {
            font-size: 18px;
            margin-bottom: 8px;
            width: 100%;
            text-align: left;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #5C6BC0;
            color: white;
            padding: 12px 20px;
            font-size: 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #3949ab;
        }

        .product-list {
            margin-top: 20px;
            text-align: left;
            width: 100%;
            max-height: 300px;
            overflow-y: scroll;
            padding-right: 10px;
        }

        .product-list li {
            list-style-type: none;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fafafa;
        }

        .product-list a {
            text-decoration: none;
            color: #5C6BC0;
            font-weight: bold;
        }

        .product-list a:hover {
            text-decoration: underline;
        }

        .product-list::-webkit-scrollbar {
            width: 6px;
        }

        .product-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .product-list::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .product-list::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }
            h1 {
                font-size: 26px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Produto</h1>
        <a href="admin-dashboard.php" class="button">Voltar</a>

        <h2>Selecione um Produto para Editar</h2>
        <ul class="product-list">
            <?php foreach ($produtos as $index => $produto): ?>
                <li>
                    <strong><?php echo $produto['nome']; ?></strong><br>
                    Preço: <?php echo $produto['preco']; ?><br>
                    Descrição: <?php echo $produto['descricao']; ?><br>
                    <a href="editar-produto.php?edit=<?php echo $index; ?>">Editar</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if ($editar_produto): ?>
            <form action="editar-produto.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="index" value="<?php echo $_GET['edit']; ?>">

                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($editar_produto['nome']); ?>" required>

                <label for="preco">Preço:</label>
                <input type="text" id="preco" name="preco" value="<?php echo htmlspecialchars($editar_produto['preco']); ?>" required>

                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required><?php echo htmlspecialchars($editar_produto['descricao']); ?></textarea>

                <label for="imagem1">Imagem 1:</label>
                <input type="file" id="imagem1" name="imagem1">

                <label for="imagem2">Imagem 2:</label>
                <input type="file" id="imagem2" name="imagem2">

                <label for="imagem3">Imagem 3:</label>
                <input type="file" id="imagem3" name="imagem3">

                <button type="submit" name="edit">Salvar Alterações</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
