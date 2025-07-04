<?php
session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin-login.php");
    exit;
}

$produtos = [];
if (file_exists('produtos.json')) {
    $produtos = json_decode(file_get_contents('produtos.json'), true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $upload_dir = "uploads/";
    $imagens = [];

    foreach (['imagem1', 'imagem2', 'imagem3'] as $campo) {
        if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES[$campo]['tmp_name'];
            $filename = basename($_FILES[$campo]['name']);
            $destination = $upload_dir . time() . '_' . $filename;

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (move_uploaded_file($tmp_name, $destination)) {
                $imagens[] = $destination;
            }
        }
    }

    $novo_produto = [
        "nome" => $nome,
        "preco" => $preco,
        "descricao" => $descricao,
        "imagens" => $imagens
    ];

    $produtos[] = $novo_produto;

    file_put_contents('produtos.json', json_encode($produtos, JSON_PRETTY_PRINT));
    header("Location: admin-dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Adicionar Produto</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #f7f7f7;
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background-color: #fff;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
    }

    h1 {
      font-size: 26px;
      margin-bottom: 20px;
      color: #333;
      text-align: center;
    }

    a.button {
      text-decoration: none;
      background-color: #5C6BC0;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 16px;
      margin-bottom: 30px;
      display: inline-block;
      transition: background-color 0.3s;
    }

    a.button:hover {
      background-color: #3949ab;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 6px;
      color: #555;
      font-size: 14px;
    }

    input, textarea {
      padding: 10px;
      margin-bottom: 18px;
      font-size: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #5C6BC0;
      color: white;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #3f51b5;
    }

    .top-bar {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 30px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="top-bar">
      <h1>Adicionar Produto</h1>
      <a href="admin-dashboard.php" class="button">Voltar</a>
    </div>

    <form action="adicionar-produto.php" method="POST" enctype="multipart/form-data">
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required>

      <label for="preco">Preço:</label>
      <input type="text" id="preco" name="preco" required>

      <label for="descricao">Descrição:</label>
      <textarea id="descricao" name="descricao" required></textarea>

      <label for="imagem1">Imagem 1:</label>
      <input type="file" id="imagem1" name="imagem1" accept="image/*" required>

      <label for="imagem2">Imagem 2:</label>
      <input type="file" id="imagem2" name="imagem2" accept="image/*">

      <label for="imagem3">Imagem 3:</label>
      <input type="file" id="imagem3" name="imagem3" accept="image/*">

      <button type="submit" name="add">Adicionar Produto</button>
    </form>
  </div>

</body>
</html>
