<!DOCTYPE html>
<?php $i = 1 ?>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title> {{$empresa->nome_fantasia}}</title>
    <link rel="stylesheett" type="text/css" href="views/css/pdfPedidos.css">
</head>
<body>
<main>
    <div id="details" class="clearfix">
        <div id="client">
            <h1 class="name">{{$empresa->nome_fantasia}}</h1>
            <div>CNPJ: {{$empresa->cnpj}} - Telefone: {{$empresa->telefone}}</div>
            <div class="address">Endereço: {{$empresa->endereco}}<br>
                Bairro: {{$empresa->bairro}} - {{$empresa->cidade}} - {{$empresa->estado}}
                <br> CEP: {{$empresa->cep}}
            </div>

        </div>
        <div id="invoice">
            <h1></h1>
            <div class="date">Data: {{$dataAtual}}</div>
        </div>
    </div>

    <h1>Cupons</h1>
    <table>
        <tbody>
        </tbody>
        <tr>
            <td class="desc"><h3>Total {{$dados['totalCupons']}} cupons!</h3></td>
            <td class="desc"><h3>Valor total: {{$dados['valorTotal']}} R$</h3></td>
        </tr>
    </table>
    @foreach($cuponsPage as $cupoms)
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th class="no">#</th>
                <th class="desc"><h3>Código</h3></th>
                <th class="desc"><h3>Valor</h3></th>
            </tr>
            </thead>
            <tbody>
            @foreach($cupoms as $cupom)
                <tr>
                    <td class="no">{{$cupom->id}}</td>
                    <td class="desc"><h3>{{$cupom->codigo}}</h3></td>
                    <td class="desc"><h3>{{$cupom->valor}}</h3></td>
                </tr>
            @endforeach
        </table>
        <footer>
            Copyright &copy; 2016 Os PrintF - <b>Páginas {{$i}} de {{$cuponsPage->count()}}</b>
        </footer>
        @if($i != $cuponsPage->count())
            <?php $i++ ?>
            <span style="page-break-after:always;"></span>
        @endif
    @endforeach
</main>
</body>
</html>