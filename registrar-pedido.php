<?php
// Define o caminho do arquivo onde os pedidos serão salvos
$arquivo = 'pedidos.json';

// Lê o corpo da requisição enviada via JavaScript (JSON)
$dadosRecebidos = file_get_contents('php://input');

// Converte os dados JSON em array associativo
$novoPedido = json_decode($dadosRecebidos, true);

// Verifica se o conteúdo recebido é válido
if (!is_array($novoPedido)) {
    http_response_code(400); // Bad Request
    echo json_encode(["erro" => "Dados inválidos."]);
    exit;
}

// Lê o conteúdo atual do arquivo (se existir)
$pedidos = [];

if (file_exists($arquivo)) {
    $conteudo = file_get_contents($arquivo);
    $pedidos = json_decode($conteudo, true);
    
    if (!is_array($pedidos)) {
        $pedidos = [];
    }
}

// Adiciona o novo pedido
$pedidos[] = $novoPedido;

// Salva tudo de volta no arquivo
file_put_contents($arquivo, json_encode($pedidos, JSON_PRETTY_PRINT));

// Responde com sucesso
http_response_code(200);
echo json_encode(["mensagem" => "Pedido registrado com sucesso."]);
?>
