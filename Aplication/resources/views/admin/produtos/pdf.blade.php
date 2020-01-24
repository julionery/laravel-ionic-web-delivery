<!DOCTYPE html>
<html lang="pt-BR">
<?php $i = 1 ?>
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

    <h1>Produtos</h1>
    <table>
        <tbody>
        </tbody>
        <tr>
            <td class="desc"><h3>Total {{$dados['totalProdutos']}} produtos!</h3></td>
            <td class="desc"><h3>Valor total: {{$dados['valorTotal']}} R$</h3></td>
        </tr>
    </table>
    @foreach($produtosPage as $produtos)
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th class="no">#</th>
                <th class="desc"><h3>Nome</h3></th>
                <th class="desc"><h3>Descrição</h3></th>
                <th class="desc"><h3>Categoria</h3></th>
                <th class="desc"><h3>Tamanho</h3></th>
                <th class="desc"><h3>Preço - R$</h3></th>
            </tr>
            </thead>
            <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td class="no">{{$produto->id}}</td>
                    <td class="desc"><h3>{{$produto->nome}}</h3></td>
                    <td class="desc"><h3>{{$produto->descricao}}</h3></td>
                    <td class="desc"><h3>{{$produto->categoria->nome}}</h3></td>
                    <td class="desc">
                        <h3>
                            @if($produto->tamanho=='N')--
                            @endif
                            @if($produto->tamanho=='B')Broto
                            @endif
                            @if($produto->tamanho=='P')Pequena
                            @endif
                            @if($produto->tamanho=='M')Média
                            @endif
                            @if($produto->tamanho=='G')Grande
                            @endif
                            @if(!$produto->tamanho)--
                            @endif
                        </h3>
                    </td>
                    <td class="desc"><h3>{{$produto->preco}}</h3></td>
                </tr>
            @endforeach
        </table>
        <footer>
            Copyright &copy; 2016 Os PrintF - <b>Páginas {{$i}} de {{$produtosPage->count()}}</b>
        </footer>
        @if($i != $produtosPage->count())
            <?php $i++ ?>
            <span style="page-break-after:always;"></span>
        @endif
    @endforeach
</main>
</body>
</html>