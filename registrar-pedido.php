<?php
$arquivo = 'pedidos.json';
file_put_contents("debug.txt", $dadosRecebidos);
$dadosRecebidos = file_get_contents('php://input');
$novoPedido = json_decode($dadosRecebidos, true);

if (!is_array($novoPedido)) {
    http_response_code(400);
    echo json_encode(["erro" => "Dados inválidos."]);
    exit;
}

$pedidos = [];
if (file_exists($arquivo)) {
    $conteudo = file_get_contents($arquivo);
    $pedidos = json_decode($conteudo, true);
    if (!is_array($pedidos)) {
        $pedidos = [];
    }
}

$pedidos[] = $novoPedido;
file_put_contents($arquivo, json_encode($pedidos, JSON_PRETTY_PRINT));
http_response_code(200);
echo json_encode(["mensagem" => "Pedido registrado com sucesso."]);
?>
