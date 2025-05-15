<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Carrinho de Compras</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4e8da;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 50px auto;
      background: #fff;
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      color: #a26f32;
      margin-bottom: 30px;
    }

    .item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 15px;
      border: 1px solid #eee;
      border-radius: 10px;
      margin-bottom: 15px;
      background-color: #fffaf4;
    }

    .item img {
      width: 80px;
      border-radius: 10px;
      margin-right: 20px;
    }

    .item-info {
      flex: 1;
    }

    .item-info h3 {
      margin: 0;
    }

    .item-info p {
      margin: 5px 0;
    }

    .item-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .item-actions input {
      width: 50px;
      padding: 5px;
      text-align: center;
      border-radius: 6px;
    }

    .remove-btn {
      background-color: #e74c3c;
      color: white;
      border: none;
      border-radius: 8px;
      padding: 5px 10px;
      cursor: pointer;
    }

    .total {
      text-align: right;
      font-size: 20px;
      margin-top: 20px;
    }

    .buttons {
      text-align: center;
      margin-top: 30px;
    }

    .buttons button {
      background-color: #d6a561;
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 10px;
      cursor: pointer;
      margin: 0 10px;
      font-size: 16px;
    }

    .buttons button:hover {
      background-color: #b88642;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Seu Carrinho</h1>
    <div id="carrinhoItens"></div>
    <div class="total" id="total">Total: R$ 0,00</div>
    <div class="buttons">
      <button onclick="window.location.href='exploracao.php'">Ver mais</button>
      <button onclick="finalizarCompra()">Finalizar Compra</button>
    </div>
  </div>

  <script>
    let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];

    function finalizarCompra() {
  const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];

  fetch('registrar-pedido.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(carrinho)
  }).then(() => {
    const mensagem = carrinho.map(item => `${item.quantidade}x ${item.nome}`).join('\n');
    const texto = encodeURIComponent("Olá, gostaria de finalizar a compra com:\n" + mensagem);
    const telefone = "5562999842949";
    const url = `https://wa.me/${telefone}?text=${texto}`;
    
    window.open(url, "_blank");
    localStorage.removeItem('carrinho');
    window.location.reload(); // atualiza a página
  });
}


      document.getElementById('total').innerText = 'Total: R$ ' + total.toFixed(2);
    }

    function atualizarQuantidade(index, novaQtd) {
      carrinho[index].quantidade = parseInt(novaQtd);
      localStorage.setItem('carrinho', JSON.stringify(carrinho));
      atualizarCarrinho();
    }

    function removerItem(index) {
      carrinho.splice(index, 1);
      localStorage.setItem('carrinho', JSON.stringify(carrinho));
      atualizarCarrinho();
    }

    function finalizarCompra() {
  const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];

  fetch('registrar-pedido.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(carrinho)
  }).then(() => {
    const mensagem = carrinho.map(item => `${item.quantidade}x ${item.nome}`).join('\n');
    const texto = encodeURIComponent("Olá, gostaria de finalizar a compra com:\n" + mensagem);
    window.location.href = "https://wa.me/SEUNUMERO?text=" + texto;
    localStorage.removeItem('carrinho');
  });
}

  let mensagem = "Olá, gostaria de finalizar a compra com:\n";

  carrinho.forEach(item => {
    mensagem += `${item.quantidade}x ${item.nome}\n`;
  });

  const telefone = "5562999842949"; 
  const url = `https://wa.me/${telefone}?text=${encodeURIComponent(mensagem)}`;

  window.open(url, "_blank");
}


    atualizarCarrinho();
  </script>

</body>
</html>
