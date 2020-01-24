<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Os PrintF</title>

{!!  Html::style('views/css/bootstrap.min.css') !!}
{!!  Html::style('views/css/fonte.css') !!}

<!-- Vendor CSS -->
{!!  Html::style('design/vendors/bower_components/animate.css/animate.min.css') !!}
{!!  Html::style('design/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') !!}

<!-- CSS -->
    {!!  Html::style('design/css/app.min.1.css') !!}
    {!!  Html::style('design/css/app.min.2.css') !!}

</head>
<body>

<div class="login-content">
    <center>
        <div class="lc-block toggled" id="l-login">
            <div class="row">
                <div class="col-xs-12">
                    <center><a href="{{ url('/') }}"><img src="{{ asset('views/imgs/logo2.png') }}" class="img-responsive"
                                 style="padding-bottom: 40px"/></a></center>
                </div>
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Oops!</strong> Houve alguns problemas com a sua entrada.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
                {!! csrf_field() !!}

                <div class="row">
                    <div class="input-group m-b-20">
                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                        <div class="fg-line">
                            <input type="email" class="form-control" placeholder="Email" name="email" autofocus
                                   value="{{ old('email') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-group m-b-20">
                        <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
                        <div class="fg-line">
                            <input type="password" placeholder="Senha" class="form-control" name="password">
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="form-group">
                    <div style="margin-top: 10px">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                    <div style="margin-top: 10px">
                        <a class="btn btn-link" href="{{ url('/auth/register') }}">Não possui uma conta? <br>Crie uma!</a>
                    </div>
                    <div>
                       <center> <a class="btn btn-link" href="https://play.google.com/store/apps/details?id=osprintf.com&hl=pt_BR" target="_blank">Baixe nosso APP!</a></center>
                    </div>
                </div>
                @if(Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
            </form>
        </div>
    </center>
</div>

<!-- Javascript Libraries -->
{!!  Html::script('design/vendors/bower_components/jquery/dist/jquery.min.js') !!}
{!!  Html::script('design/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}

{!!  Html::script('design/vendors/bower_components/Waves/dist/waves.min.js') !!}

<!-- Placeholder for IE9 -->
<!--[if IE 9 ]>
{!!  Html::script('design/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js') !!}
<![endif]-->

{!!  Html::script('design/js/functions.js') !!}
</body>
</html>