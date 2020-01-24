<!DOCTYPE html>
<?php $i = 1 ?>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title> Pedidos</title>
    <link rel="stylesheett" type="text/css" href="views/css/pdfPedidos.css">
</head>
<body>
<main>
    <h1>Pedidos</h1>
    <table>
        <tbody>
        </tbody>
        <tr>
            <td><h3>Total {{$dados['totalPedidos']}} pedidos!</h3></td>
            <td class="total"><h3>Valor total: {{$dados['valorTotal']}} R$</h3></td>
        </tr>
    </table>
    @foreach($pedidosPage as $pedidos)
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th class="no">#</th>
                <th class="desc"><h3>Data</h3></th>
                <th class="desc"><h3>Entregador</h3></th>
                <th class="desc"><h3>Status</h3></th>
                <th class="desc"><h3>Valor - R$</h3></th>
            </tr>
            </thead>
            <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td class="no">#{{$pedido->id}}</td>
                    <td class="desc"><h3>{{date('d/m/Y - H:i', strtotime($pedido->created_at))}}</h3></td>
                    <td class="desc">
                        <h3>
                        @if($pedido->entregador)
                            {{$pedido->entregador->nome}}
                        @else
                            --
                        @endif
                            </h3>
                    </td>
                    <td class="desc">

                        <h3>
                        @if($pedido->status==0)Pendente
                        @endif
                        @if($pedido->status==1)Recebido
                        @endif
                        @if($pedido->status==2)Em preparação
                        @endif
                        @if($pedido->status==3)A caminho
                        @endif
                        @if($pedido->status==4)Entregue
                        @endif
                        @if($pedido->status==5)Cancelado
                        @endif
                            </h3>
                    </td>
                    <td class="desc"><h3>{{$pedido->total}}</h3></td>
                </tr>
            @endforeach
        </table>
        <footer>
            Copyright &copy; 2016 Os PrintF - <b>Páginas {{$i}} de {{$pedidosPage->count()}}</b>
        </footer>
        @if($i != $pedidosPage->count())
            <?php $i++ ?>
            <span style="page-break-after:always;"></span>
        @endif
    @endforeach

</main>

</body>
</html>