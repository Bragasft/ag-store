<?php
$produtos = [];
if (file_exists('produtos.json')) {
    $produtos = json_decode(file_get_contents('produtos.json'), true);
}

$id = $_GET['id'] ?? 0;
$produto = $produtos[$id] ?? null;

if (!$produto) {
    echo "Produto não encontrado.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title><?php echo $produto['nome']; ?> - Detalhes do Produto</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5ebe0;
      margin: 0;
      padding: 0;
      text-align: center;
    }

    .container {
      max-width: 700px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .carousel {
      position: relative;
      overflow: hidden;
      border-radius: 16px;
    }

    .carousel-images {
      display: flex;
      transition: transform 0.4s ease-in-out;
    }

    .carousel-images img {
      width: 100%;
    }

    .arrow {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background-color: rgba(0,0,0,0.4);
      color: #fff;
      border: none;
      padding: 8px 12px;
      cursor: pointer;
      border-radius: 50%;
    }

    .arrow-left {
      left: 10px;
    }

    .arrow-right {
      right: 10px;
    }

    h2 {
      margin: 20px 0 10px;
    }

    p {
      color: #555;
    }

    .price {
      font-size: 22px;
      font-weight: bold;
      color: #000;
      margin: 15px 0;
    }

    button {
      padding: 10px 20px;
      background-color: #d6a561;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #b88642;
    }

    .reviews-section {
      margin-top: 40px;
      text-align: left;
    }

    .review {
      background: #fffaf4;
      border: 1px solid #e3d5ca;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 15px;
    }

    .stars {
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .star {
      width: 24px;
      height: 24px;
      background: lightgray;
      clip-path: polygon(
        50% 0%, 61% 35%, 98% 35%, 68% 57%,
        79% 91%, 50% 70%, 21% 91%, 32% 57%,
        2% 35%, 39% 35%
      );
    }

    .star-filled {
      background: gold;
    }

    .star-partial {
      background: linear-gradient(to right, gold 80%, lightgray 80%);
    }
    .btn-carrinho {
  position: absolute;     /* ou fixed se quiser flutuando sempre na tela */
  top: 15px;
  right: 30px;
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 15px;
  background-color: #28a745; /* verde preenchido */
  color: white;
  border: 2px solid #218838;
  border-radius: 8px;
  text-decoration: none;
  font-weight: bold;
  z-index: 1000;
  transition: background-color 0.3s ease;
}

.btn-carrinho:hover {
  background-color: #218838;
}

.btn-carrinho img {
  width: 24px;
  height: 24px;
  object-fit: contain;
}

  </style>
</head>
<body>

  <div class="container">
    <!-- Carrossel -->
    <div class="carousel">
      <div class="carousel-images" id="carouselImages">
        <?php foreach ($produto['imagens'] as $imagem): ?>
          <img src="<?php echo $imagem; ?>" alt="<?php echo $produto['nome']; ?>">
        <?php endforeach; ?>
      </div>
      <button class="arrow arrow-left" onclick="prevSlide()">❮</button>
      <button class="arrow arrow-right" onclick="nextSlide()">❯</button>
    </div>
    <a href="carrinho.php" class="btn-carrinho">
  <img src="carrinho.png" alt="Carrinho" />
  <span>Ver Carrinho</span>
</a>



    <!-- Nome, Preço e Descrição -->
    <h2><?php echo $produto['nome']; ?></h2>
    <p class="price">R$ <?php echo $produto['preco']; ?></p>
    <p><?php echo $produto['descricao']; ?></p>

    <!-- Botão adicionar ao carrinho -->
    <button onclick="adicionarProduto()">Adicionar ao carrinho</button>

    <!-- Avaliações -->
    <div class="reviews-section">
      <h3>Avaliações</h3>

      <div class="review">
        <strong>Ana Paula</strong>
        <p>Perfume maravilhoso! Fixação excelente.</p>
        <div class="stars">
          <div class="star star-filled"></div>
          <div class="star star-filled"></div>
          <div class="star star-filled"></div>
          <div class="star star-filled"></div>
          <div class="star star-partial"></div>
        </div>
      </div>

      <div class="review">
        <strong>Juliana M.</strong>
        <p>Gostei bastante, mas esperava mais do frasco.</p>
        <div class="stars">
          <div class="star star-filled"></div>
          <div class="star star-filled"></div>
          <div class="star star-filled"></div>
          <div class="star star-filled"></div>
          <div class="star"></div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const carousel = document.getElementById("carouselImages");
    const totalSlides = carousel.children.length;
    let currentIndex = 0;

    function updateSlide() {
      const offset = -currentIndex * 100;
      carousel.style.transform = `translateX(${offset}%)`;
    }

    function prevSlide() {
      currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
      updateSlide();
    }

    function nextSlide() {
      currentIndex = (currentIndex + 1) % totalSlides;
      updateSlide();
    }

    function adicionarProduto() {
      const nome = '<?php echo $produto['nome']; ?>';
      const preco = '<?php echo $produto['preco']; ?>';
      const imagemAtual = document.querySelectorAll('#carouselImages img')[currentIndex].getAttribute('src');

      let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
      
      let itemExistente = carrinho.find(item => item.nome === nome);
      if (itemExistente) {
        itemExistente.quantidade += 1;
      } else {
        carrinho.push({ nome, preco, imagem: imagemAtual, quantidade: 1 });
      }
    
      localStorage.setItem('carrinho', JSON.stringify(carrinho));

      window.location.href = 'carrinho.php';
    }

    window.onload = updateSlide;
  </script>

</body>
</html>
