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

if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    if (isset($produtos[$index])) {
        unset($produtos[$index]);
        $produtos = array_values($produtos);
        file_put_contents('produtos.json', json_encode($produtos, JSON_PRETTY_PRINT));
        header("Location: excluir-produto.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Excluir Produto</title>
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
      max-width: 800px;
    }

    h1 {
      font-size: 26px;
      color: #333;
      margin-bottom: 10px;
      text-align: center;
    }

    a.button {
      text-decoration: none;
      background-color: #5C6BC0;
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 16px;
      display: inline-block;
      transition: background-color 0.3s;
      margin-bottom: 20px;
    }

    a.button:hover {
      background-color: #3949ab;
    }

    .produtos-lista {
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      max-height: 400px;
      overflow-y: auto;
      padding-right: 10px;
    }

    .produto-card {
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 16px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .produto-card strong {
      font-size: 18px;
      color: #333;
    }

    .produto-card p {
      margin: 4px 0;
      color: #555;
    }

    .produto-card img {
      margin-top: 10px;
      width: 100px;
      border-radius: 4px;
    }

    .produto-card a.excluir {
      display: inline-block;
      margin-top: 10px;
      background-color: #e74c3c;
      color: white;
      padding: 8px 14px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .produto-card a.excluir:hover {
      background-color: #c0392b;
    }

    /* Scroll personalizado */
    .produtos-lista::-webkit-scrollbar {
      width: 6px;
    }

    .produtos-lista::-webkit-scrollbar-thumb {
      background: #ccc;
      border-radius: 6px;
    }

    .produtos-lista::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    .container a.button {
        display: inline-block;
        text-align: center;
        margin: 0 auto;
    }



  </style>
</head>
<body>

  <div class="container">
  <h1>Excluir Produto</h1>

  <div style="text-align: center;">
    <a href="admin-dashboard.php" class="button">Voltar</a>
  </div>

   <div class="produtos-lista">
      <?php foreach ($produtos as $index => $produto): ?>
        <div class="produto-card">
          <strong><?php echo htmlspecialchars($produto['nome']); ?></strong>
          <p>Preço: <?php echo htmlspecialchars($produto['preco']); ?></p>
          <p>Descrição: <?php echo htmlspecialchars($produto['descricao']); ?></p>
          <?php if (!empty($produto['imagens'][0])): ?>
            <img src="<?php echo htmlspecialchars($produto['imagens'][0]); ?>" alt="Imagem do Produto">
          <?php endif; ?>
          <br>
          <a href="excluir-produto.php?remove=<?php echo $index; ?>" class="excluir">Excluir Produto</a>
        </div>
      <?php endforeach; ?>
    </div>
</body>
</html>
