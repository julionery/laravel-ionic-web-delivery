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

    <h1>Ingredientes</h1>
    <table>
        <tbody>
        </tbody>
        <tr>
            <td class="desc"><h3>Total {{$dados['totalIngredientes']}} ingredientes!</h3></td>
        </tr>
    </table>
    @foreach($ingredientesPage as $ingredientes)
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th class="no">#</th>
                <th class="desc"><h3>Nome</h3></th>
            </tr>
            </thead>
            <tbody>
            @foreach($ingredientes as $ingrediente)
                <tr>
                    <td class="no">{{$ingrediente->id}}</td>
                    <td class="desc"><h3>{{$ingrediente->nome}}</h3></td>
                </tr>
            @endforeach
        </table>
        <footer>
            Copyright &copy; 2016 Os PrintF - <b>Páginas {{$i}} de {{$ingredientesPage->count()}}</b>
        </footer>
        @if($i != $ingredientesPage->count())
            <?php $i++ ?>
            <span style="page-break-after:always;"></span>
        @endif
    @endforeach
</main>
</body>
</html>