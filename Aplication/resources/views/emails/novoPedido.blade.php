    <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title> Os PrintF</title>
</head>
<body>
<h1>Pedido #{{$pedido->id}} - R$ {{$pedido->total}}</h1>
<h2>Cliente: {{$pedido->cliente->usuario->nome}} </h2>
<h2>Telefone: {{$pedido->cliente->telefone}}</h2>
<h3>Data: {{date('d/m/Y - H:i:s', strtotime($pedido->created_at))}}</h3>
<h4>
    <br>
    <b>Entregar em:</b> <br>

    {{$pedido->cliente->endereco}} - {{$pedido->cliente->cidade}} - {{$pedido->cliente->estado}}
    <br>
</h4>
    <h3>Modelo de Retirada: {{$pedido->retirada}}</h3>
    <h3>Forma de Pagamento: {{$pedido->pagamento}}</h3>
<br>

    @foreach($pedido->itens as $item)
            <p>Qtd: {{$item->qtd}} - Produto: {{$item->produto->nome}}</p>
            @if($item->produto->tamanho!="N")
            <p>Tamanho:
                @if($item->produto->tamanho=="N")
                @endif
                @if($item->produto->tamanho=="B")Broto
                @endif
                @if($item->produto->tamanho=="P")Pequena
                @endif
                @if($item->produto->tamanho=="M")Média
                @endif
                @if($item->produto->tamanho=="G")Grande
                @endif
            </p>
            @endif

            @if($item->meia == 1)<p>Meia: Sim </p>
                @endif
            @if($item->obs!="")
            <p>Observação: {{$item->obs}}</p>
            @endif
            <br>
    @endforeach
</body>
</html>