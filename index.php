<?php
// Carregando os produtos destacados do arquivo JSON
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
  <title>AG STORE</title>
  <link rel="stylesheet" href="index.css" />
</head>
<body>
  <header class="hero">
    <div class="overlay">
      <h1>Descubra fragrâncias que definem você</h1>
      <p>Fragrâncias inspiradas, preços especiais, entrega rápida.</p>
     <div class="buttons">
      <a href="exploracao.PHP" class="btn">EXPLORAR</a>
    </div>

    </div>
  </header>
  

  <section class="benefits">
    <h2>Por que comprar com a gente?</h2>
    <div class="benefit-list">
      <div><img src="perfume.png" alt=""><p>Fragrâncias inspiradas nas grandes marcas</p></div>
      <div><img src="delivery-truck.png" alt=""><p>Entrega rápida e segura</p></div>
      <div><img src="payment-method.png" alt=""><p>Pagamento facilitado</p></div>
    </div>
  </section>

  <section class="products">
    <h2>Perfumes em destaque</h2>
    <div class="product-grid">
      <div class="product">
        <a href="prod-destaque04.html">
          <img src="PERFUME DESTAQUE 04.png" alt="Asad">
        </a>
        <p><strong>ASAD</strong><br>Lattafa<br><span>R$ 444,44</span></p>
      </div>
      <div class="product">
        <a href="prod-destaque03.html">
          <img src="PERFUME DESTAQUE 03.png" alt="Sabah">
        </a>
        <p><strong>Sabah Al Ward</strong><br>Lattafa<br><span>R$ 333,33</span></p>
      </div>
      <div class="product">
        <a href="prod-destaque02.html">
          <img src="PERFUME DESTAQUE 02.png" alt="Yara">
        </a>
        <p><strong>Yara</strong><br>Lattafa<br><span>R$ 222,22</span></p>
      </div>
      <div class="product">
        <a href="prod-destaque01.html">
          <img src="PERFUME DESTAQUE 01.png" alt="Mont'Anne">
        </a>
        <p><strong>I Love Mont'Anne</strong><br>Parfums Mont Anne<br><span>R$ 111,11</span></p>
      </div>
    </div>
  </section>

  <section class="testimonial">
    <p>“Perfume chegou antes do prazo e com excelente qualidade!”</p>
  </section>

  <div class="footer-container">
  <button class="footer-btn">
    <a href="https://api.whatsapp.com/send?phone=556299842949&text=Ol%C3%A1!%20Gostaria%20de%20saber%20mais%20sobre%20os%20perfumes." target="_blank">
      <i><img src="whatsapp.png" alt="icone do whatsapp"></i> Whatsapp
    </a>
  </button>

  <button class="footer-btn">
    <a href="https://www.instagram.com/ag_store_24?igsh=aHp6bzdnd3N5YW90" target="_blank">
      <i><img src="instagramm.png" alt="icone do instagram"></i>Instagram
    </a>
  </button>
</div>

</body>
</html>
