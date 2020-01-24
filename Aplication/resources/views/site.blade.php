<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Os PrintF</title>

    <link href="{{ asset('views/css/fonte.css') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('views/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('views/css/estilo.css') }}" rel="stylesheet">
    <script src="{{ asset('views/js/jquery.ui.totop.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="{{ asset('views/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('views/js/respond.min.js') }}"></script>
    <link rel="shortcut icon" href="/favicon.ico"/>
    <![endif]-->

</head>
<body data-spy="scroll" data-target=".menu-navegacao" data-offset="300">
<!-- Redes Sociais -->
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <center> <img src="{{ asset('views/imgs/logo2.png') }}" class="img-responsive"/></center>
        </div>
    </div>
</div>
<!-- // Redes Sociais -->

<!-- Menu da Aplicação -->
<nav class="navbar navbar-default navbar-fixed-top divcolorida">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-navegacao">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Os PrintF</a>
        </div>

        <div class="collapse navbar-collapse menu-navegacao" id="menu-navegacao">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="" href="#servicos">Serviços</a>
                </li>
                <li>
                    <a class="" href="#menu">Menu</a>
                </li>
                <li>
                    <a class="" href="#quemsomos">Quem Somos</a>
                </li>
                <li>
                    <a class="" href="#localizacao">Localização</a>
                </li>
                <li>
                    <a class="" href="#contato">Contato</a>
                </li>
                <li>
                    <a class="" href="{{ url('/auth/register') }}">Registre-se</a>
                </li>
                <li>
                    <a class="" href="{{ url('/auth/login') }}">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- // Menu da Aplicação -->


@yield('content')


<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <p>&copy; Copyright &copy; 2016. Company PrintF all rights reserved.</p>
            </div>
            <div class="col-sm-2 text-right">
                <small>Desenvolvido por:</small><br>
                <strong>Júlio Nery</strong>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('views/js/jquery.min.js') }}"></script>
<script src="{{ asset('views/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('views/js/main.js') }}"></script>
{!!  Html::script('design/vendors/input-mask/input-mask.min.js') !!}
</body>
</html>