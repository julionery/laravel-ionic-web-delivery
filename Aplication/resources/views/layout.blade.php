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
{!!  Html::style('design/vendors/bootgrid/jquery.bootgrid.min.css') !!}
{!!  Html::style('design/vendors/bower_components/animate.css/animate.min.css') !!}
{!!  Html::style('design/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') !!}

<!-- CSS -->
    {!!  Html::style('design/css/app.min.1.css') !!}
    {!!  Html::style('design/css/app.min.2.css') !!}
    {!!  Html::style('views/select2-4.0.3/dist/css/select2.min.css') !!}
</head>
<body>
<header id="header">
    <ul class="header-inner">
        <li id="menu-trigger" data-trigger="#sidebar">
            <div class="line-wrap">
                <div class="line top"></div>
                <div class="line center"></div>
                <div class="line bottom"></div>
            </div>
        </li>

        <li class="logo hidden-xs">
            <a href="{{ url('/') }}">Os PrintF</a>
        </li>

        <li class="pull-right">
            <ul class="top-menu">
                <li id="toggle-width">
                    <div class="toggle-switch">
                        <input id="tw-switch" type="checkbox" hidden="hidden">
                        <label for="tw-switch" class="ts-helper"></label>
                    </div>
                </li>

                <li class="dropdown">
                    <a data-toggle="dropdown" class="tm-settings" href=""></a>
                    <ul class="dropdown-menu dm-icon pull-right">
                        <li class="hidden-xs">
                            <a data-action="fullscreen" href=""><i class="zmdi zmdi-fullscreen"></i> Tela Cheia</a>
                        </li>
                        @if(Auth::user()->tipo == "desenvolvedor" || Auth::user()->tipo == "admin")
                            <li><a href="{{ route('admin.perfil.index') }}"><i class="zmdi zmdi-face"></i> Perfil</a>
                            </li>
                        @endif
                        @if(Auth::user()->tipo == "cliente")
                            <li><a href="{{ route('customer.perfil.index') }}"><i class="zmdi zmdi-face"></i> Perfil</a>
                            </li>
                        @endif
                        @if(Auth::user()->tipo == "desenvolvedor" || Auth::user()->tipo == "admin")
                            <li><a href="{{ route('admin.configuracoes.index') }}"><i class="zmdi zmdi-settings"></i>Configurações</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ url('/auth/logout') }}"><i class="zmdi zmdi-time-restore"></i> Sair</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>

        <!-- Top Search Content -->
        <div id="top-search-wrap">
            <input type="text">
            <i id="top-search-close">&times;</i>
        </div>
    </ul>
</header>

<section id="main">
    <aside id="sidebar">
        <div class="sidebar-inner c-overflow">
            <div class="profile-menu">
                <a href="">
                    <div class="profile-pic">
                    </div>

                    <div class="profile-info">
                        {{Auth::user()->nome}}
                        <i class="zmdi zmdi-arrow-drop-down"></i>
                    </div>
                </a>

                <ul class="main-menu">
                    @if(Auth::user()->tipo == "desenvolvedor" || Auth::user()->tipo == "admin")
                        <li><a href="{{ route('admin.perfil.index') }}"><i class="zmdi zmdi-account"></i>Perfil</a></li>
                    @endif
                    @if(Auth::user()->tipo == "cliente")
                        <li><a href="{{ route('customer.perfil.index') }}"><i class="zmdi zmdi-account"></i>Perfil</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ url('/auth/logout') }}"><i class="zmdi zmdi-time-restore"></i> Sair</a>
                    </li>
                </ul>
            </div>

            <ul class="main-menu">
                @if(Auth::user())
                    @if(Auth::user()->tipo == "desenvolvedor")
                        <li><a href="{{ route('admin.componentes.index') }}"><i class="zmdi zmdi-layers zmdi-hc-fw"></i>Adicionais</a></li>
                        <li><a href="{{ route('admin.categorias.index') }}"><i class="zmdi zmdi-tag-more zmdi-hc-fw"></i> Categorias</a></li>
                        <li><a href="{{ route('admin.clientes.index') }}"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>Clientes</a></li>
                        <li><a href="{{ route('admin.configuracoes.index') }}"><i class="zmdi zmdi-settings zmdi-hc-fw"></i>Configurações</a></li>
                        <li><a href="{{ route('admin.cupoms.index') }}"><i class="zmdi zmdi-receipt zmdi-hc-fw"></i>Cupons</a></li>
                        <li><a href="{{ route('admin.empresas.index') }}"><i class="zmdi zmdi-case zmdi-hc-fw"></i>Empresas</a></li>
                        <li><a href="{{ route('admin.entregadores.index') }}"><i class="zmdi zmdi-account-box zmdi-hc-fw"></i>Funcionários</a></li>
                        <li><a href="{{ route('admin.ingredientes.index') }}"><i class="zmdi zmdi-toys zmdi-hc-fw"></i>Ingredientes</a></li>
                        <li><a href="{{ url('/home') }}"><i class="zmdi zmdi-home"></i>Início</a></li>
                        <li><a href="{{ route('admin.pedidos.index') }}"><i class="zmdi zmdi-local-mall zmdi-hc-fw"></i>Pedidos</a></li>
                        <li><a href="{{ route('admin.produtos.index') }}"><i class="zmdi zmdi-local-dining zmdi-hc-fw"></i>Produtos</a></li>

                    @elseif(Auth::user()->tipo == "admin")
                        <li><a href="{{ route('admin.componentes.index') }}"><i class="zmdi zmdi-layers zmdi-hc-fw"></i>Adicionais</a></li>
                        <li><a href="{{ route('admin.categorias.index') }}"><i class="zmdi zmdi-tag-more zmdi-hc-fw"></i> Categorias</a></li>
                        <li><a href="{{ route('admin.clientes.index') }}"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>Clientes</a></li>
                        <li><a href="{{ route('admin.configuracoes.index') }}"><i class="zmdi zmdi-settings zmdi-hc-fw"></i>Configurações</a></li>
                        <li><a href="{{ route('admin.cupoms.index') }}"><i class="zmdi zmdi-receipt zmdi-hc-fw"></i>Cupons</a></li>
                        <li><a href="{{ route('admin.entregadores.index') }}"><i class="zmdi zmdi-account-box zmdi-hc-fw"></i>Funcionários</a></li>
                        <li><a href="{{ route('admin.ingredientes.index') }}"><i class="zmdi zmdi-toys zmdi-hc-fw"></i>Ingredientes</a></li>
                        <li><a href="{{ url('/home') }}"><i class="zmdi zmdi-home"></i>Início</a></li>
                        <li><a href="{{ route('admin.pedidos.index') }}"><i class="zmdi zmdi-local-mall zmdi-hc-fw"></i>Pedidos</a></li>
                        <li><a href="{{ route('admin.produtos.index') }}"><i class="zmdi zmdi-local-dining zmdi-hc-fw"></i> Produtos</a></li>

                    @elseif(Auth::user()->tipo == "cliente")
                        <li><a href="{{ url('/home') }}"><i class="zmdi zmdi-home"></i>Início</a></li>
                        <li><a href="{{ route('customer.pedido.index') }}"><i class="zmdi zmdi-local-mall zmdi-hc-fw"></i>Meus Pedidos</a></li>
                    @endif
                @endif
            </ul>
        </div>
    </aside>
    <section id="content">
        <div class="container">
            @yield('content')

        </div>
    </section>
</section>

<footer id="footer">
    <p> Copyright &copy; 2016 Os PrintF</p>
    <ul class="f-menu">
        <li><a href="{{ url('/') }}">Os PrintF</a></li>
        <li><a href="https://www.facebook.com/julio.cesar.an" target="_blank">Facebook</a></li>
        <li><a href="https://plus.google.com/112410937014698265478" target="_blank">Google+</a></li>
        <li><a href="mailto:juliocesaralmeidanery@gmail.com?Subject=Suporte Portal" target="_top">Suporte</a></li>
        <li><a href="mailto:julio_cesar.an@hotmail.com?Subject=Contato Portal" target="_top">Contatos</a></li>
    </ul>
</footer>

<!-- Javascript Libraries -->
{!!  Html::script('design/vendors/bower_components/jquery/dist/jquery.min.js') !!}
{!!  Html::script('design/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}

{!!  Html::script('design/vendors/bower_components/moment/min/moment.min.js') !!}
{!!  Html::script('design/vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') !!}
{!!  Html::script('design/vendors/bower_components/jquery.nicescroll/jquery.nicescroll.min.js') !!}
{!!  Html::script('design/vendors/bootstrap-growl/bootstrap-growl.min.js') !!}
{!!  Html::script('design/vendors/bootgrid/jquery.bootgrid.js') !!}
{!!  Html::script('design/js/functions.js') !!}
{!!  Html::script('design/js/demo.js') !!}
{!!  Html::script('views/select2-4.0.3/dist/js/select2.min.js') !!}

@stack('scripts')
@yield('post-script')

</body>
</html>