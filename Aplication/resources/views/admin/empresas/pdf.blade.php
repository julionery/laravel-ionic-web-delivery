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

    <h1>Empresas</h1>
    <table>
        <tbody>
        </tbody>
        <tr>
            <td class="desc"><h3>Total {{$dados['totalEmpresas']}} empresas!</h3></td>
        </tr>
    </table>
    @foreach($empresasPage as $empresas)
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th class="no">CNPJ</th>
                <th class="desc"><h3>Nome</h3></th>
                <th class="desc"><h3>Telefone</h3></th>
                <th class="desc"><h3>CEP</h3></th>
                <th class="desc"><h3>Endereço</h3></th>
                <th class="desc"><h3>Consumação<br>Mínima</h3></th>
                <th class="desc"><h3>Horário de<br>funcionamento</h3></th>
                <th class="desc"><h3>Status</h3></th>
            </tr>
            </thead>
            <tbody>
            @foreach($empresas as $empresa)
                <tr>
                    <td class="no">{{$empresa->cnpj}}</td>
                    <td class="desc"><h3>{{$empresa->nome_fantasia}}</h3></td>
                    <td class="desc"><h3>{{$empresa->telefone}}</h3></td>
                    <td class="desc"><h3>{{$empresa->cep}}</h3></td>
                    <td class="desc"><h3>{{$empresa->endereco}} - {{$empresa->bairro}} - {{$empresa->cidade}}
                            - {{$empresa->estado}}</h3></td>
                    <td class="desc"><h3>{{$empresa->consumacao_minima}}</h3></td>
                    <td class="desc"><h3>De {{date('H:i', strtotime($empresa->abertura))}}
                            até {{date('H:i', strtotime($empresa->fechamento))}}</h3></td>
                    <td class="desc">
                        <h3>
                            @if($empresa->status == 0)Fechado
                            @endif
                            @if($empresa->status == 1)Aberto
                            @endif
                        </h3>
                    </td>
                </tr>
            @endforeach
        </table>
        <footer>
            Copyright &copy; 2016 Os PrintF - <b>Páginas {{$i}} de {{$empresasPage->count()}}</b>
        </footer>
        @if($i != $empresasPage->count())
            <?php $i++ ?>
            <span style="page-break-after:always;"></span>
        @endif
    @endforeach
</main>
</body>
</html>