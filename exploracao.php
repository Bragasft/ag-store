<?php
$produtos = [];
if (file_exists('produtos.json')) {
    $produtos = json_decode(file_get_contents('produtos.json'), true);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Explorar Fragrâncias - AG STORE</title>
  <link rel="stylesheet" href="index.css" />
  <style>
    .product-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      justify-content: center;
      padding: 20px;
    }
    .product-card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 260px;
      text-align: center;
      padding: 20px;
      transition: transform 0.2s ease-in-out;
      cursor: pointer;
      animation: pulse 2s infinite;
    }
    .product-card:hover {
      transform: scale(1.05);
    }
    .product-card img {
      width: 100%;
      border-radius: 10px;
    }
    .product-details h3 {
      margin: 10px 0 5px 0;
    }
    .description {
      font-size: 0.9rem;
      color: #666;
    }
    .price {
      font-weight: bold;
      margin: 10px 0;
    }
    .add-to-cart {
      background-color: #d2a86c;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }
    @keyframes pulse {
      0% { box-shadow: 0 0 0 0 rgba(210, 168, 108, 0.4); }
      70% { box-shadow: 0 0 0 15px rgba(210, 168, 108, 0); }
      100% { box-shadow: 0 0 0 0 rgba(210, 168, 108, 0); }
    }.btn-carrinho {
  position: fixed;
  top: 20px;
  right: 30px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 4px;
  width: 80px;
  height: 80px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 50%;
  text-decoration: none;
  font-weight: bold;
  font-size: 12px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
  z-index: 1000;
  transition: transform 0.3s ease, background-color 0.3s ease;
}

.btn-carrinho:hover {
  background-color: #218838;
  transform: scale(1.05);
}

.btn-carrinho img {
  width: 26px;
  height: 26px;
  object-fit: contain;
}


  </style>
</head>
<body>
  <header class="hero">
    <div class="overlay">
      <h1>Explore nossa coleção de fragrâncias</h1>
      <p>Perfumes inspirados nas melhores marcas, com preços acessíveis.</p>
      <div class="buttons">
        <a href="index.php" class="btn">Voltar à página principal</a>
      </div>
    </div>
  </header>
  <a href="carrinho.php" class="btn-carrinho">
  <img src="carrinho.png" alt="Carrinho">
  <span>Ver Carrinho</span>
</a>

  <section class="products">
    <h2>Todos os Produtos</h2>
    <div class="product-grid">
        <?php foreach ($produtos as $index => $produto): ?>
            <div class="product-card" onclick="window.location.href='ver-produto.php?id=<?php echo $index; ?>'">
                <img src="<?php echo $produto['imagens'][0]; ?>" alt="Imagem do produto">
                <div class="product-details">
                    <h3><?php echo $produto['nome']; ?></h3>
                    <p class="description"><?php echo $produto['descricao']; ?></p>
                    <p class="price">R$ <?php echo $produto['preco']; ?></p>
                    <button class="add-to-cart" onclick="event.stopPropagation(); adicionarAoCarrinho('<?php echo $produto['nome']; ?>', '<?php echo $produto['preco']; ?>', '<?php echo $produto['imagens'][0]; ?>')">Adicionar ao Carrinho</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="carrinho.php" class="btn-carrinho">
  <img src="carrinho.png" alt="Carrinho" />
  <span>Ver Carrinho</span>
</a>

  </section>

  <script>
    function adicionarAoCarrinho(nome, preco, imagem) {
      let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
      carrinho.push({ nome, preco, imagem, quantidade: 1 });
      localStorage.setItem('carrinho', JSON.stringify(carrinho));
      window.location.href = 'carrinho.php';
    }
  </script>
</body>
</html>
