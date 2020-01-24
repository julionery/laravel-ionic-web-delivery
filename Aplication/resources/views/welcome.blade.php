@extends('site')

@section('content')

    <style>
        div.divslider{
            width: 100%;
            margin: auto;
        }

        .carousel-inner > .item > img,
        .carousel-inner > .item > a > img{
            width: 80%;
            margin: auto;
        }
    </style>

<!-- Slider da Aplicação -->
<div class="divslider">
    <!-- <div class="container">
        <div class="col-xs-12"> -->
    <div id="sliderprincipal" class="carousel slide" data-ride="carousel">

        <ol class="carousel-indicators">
            <li data-target="#sliderprincipal" data-slide-to="0" class="active"></li>
            <li data-target="#sliderprincipal" data-slide-to="1"></li>
            <li data-target="#sliderprincipal" data-slide-to="2"></li>
            <li data-target="#sliderprincipal" data-slide-to="3"></li>
            <li data-target="#sliderprincipal" data-slide-to="4"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
            <div class="item active"  onClick="javascript:location.href='auth/register'">
                <img src="{{ asset('views/imgs/slider/OsPrintF.png') }}" alt="Imagem slider 1">
            </div>
            <div class="item">
                    <img src="{{ asset('views/imgs/slider/slide1.jpg') }}" alt="Imagem slider 2">
            </div>
            <div class="item">
                    <img src="{{ asset('views/imgs/slider/slide2.jpg') }}" alt="Imagem slider 3">
            </div>
            <div class="item">
                    <img src="{{ asset('views/imgs/slider/slide3.jpg') }}" alt="Imagem slider 4">
            </div>
            <div class="item">
                   <img src="{{ asset('views/imgs/slider/slide4.jpg') }}" alt="Imagem slider 5">
            </div>
        </div>
        <a class="left carousel-control" href="#sliderprincipal" role="button" data-slide="prev">
            <span class="icon-prev" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="right carousel-control" href="#sliderprincipal" role="button" data-slide="next">
            <span class="icon-next" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>
    <!--  </div>
  </div> -->
</div>
<!-- // Slider da Aplicação -->


<!-- Serviços -->
<section id="servicos">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header"><h1>Serviços <small>Conheça o que fazemos!</small></h1></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-4 itemServicos">
                <div><img src="{{ asset('views/imgs/pizzada.jpg') }}" class="img-responsive img-circle"/></div>
                <h4>Pizzada</h4>
                <p> Comemore seu aniversário ou leve para seu evento a Pizzada dos PrintF!<br> Preencha o formulário que os PrintF vai até você! </p>
                <div class="col-xs-12 text-center">
                    <a href="{{ url('auth/register') }}" class="btn btn-default btn-lg itemServicos_todosOsServicos">Mais informações!</a>
                </div>
            </div>

            <div class="col-sm-4 col-md-4 itemServicos">
                <div><img src="{{ asset('views/imgs/delivery2.png') }}" class="img-responsive img-circle"/></div>
                <h4>Delivery Rápido</h4>
                <p> Receba no conforto do seu lar os melhores pratos que a Fabbrica tem a oferecer utilizando nosso <br>Delivery Online</p>
                <div class="col-xs-12 text-center">
                    <a href="auth/register" class="btn btn-default btn-lg itemServicos_todosOsServicos">Mais informações!</a>
                </div>
            </div>

            <div class="col-sm-4 col-md-4 itemServicos">
                <div><img src="{{ asset('views/imgs/comemoracoes.jpeg') }}" class="img-responsive img-circle"/></div>
                <h4>Comemorações</h4>
                <p> Os PrintF estão preparados para receber com carinho sua comemoração, desde aniversários e formaturas até eventos corporativos. </p>
                <div class="col-xs-12 text-center">
                    <a href="{{ url('auth/register') }}" class="btn btn-default btn-lg itemServicos_todosOsServicos">Mais informações!</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- // Serviços -->



<!-- Menu -->
<section id="menu" class="divcolorida">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header"><h1>Menu <small>Conheça nossos cardápios!</small></h1></div>
            </div>
        </div>

        <div class="row rowMenu">
            <div class="col-sm-4 col-md-4">
                <div class="itemMenu">
                    <div><img src="{{ asset('views/imgs/cardapioPizza.jpg') }}" class="img-responsive img-rounded"/></div>
                    <div class="col-xs-12 text-center itemBotao">
                        <a href="auth/register" class="btn btn-default btn-lg">Pizzas</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="itemMenu">
                    <div><img src="{{ asset('views/imgs/cardapioSalada.jpg') }}" class="img-responsive img-rounded"/></div>
                    <div class="col-xs-12 text-center itemBotao">
                        <a href="auth/register" class="btn btn-default btn-lg">Saladas</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="itemMenu">
                    <div><img src="{{ asset('views/imgs/cardapioMassas.jpg') }}" class="img-responsive img-rounded"/></div>
                    <div class="col-xs-12 text-center itemBotao">
                        <a href="auth/register" class="btn btn-default btn-lg">Massas</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row rowMenu">
            <div class="col-sm-4 col-md-4">
                <div class="itemMenu">
                    <div><img src="{{ asset('views/imgs/cardapioPratos.jpg') }}" class="img-responsive img-rounded"/></div>
                    <div class="col-xs-12 text-center itemBotao">
                        <a href="auth/register" class="btn btn-default btn-lg">Pratos</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="itemMenu">
                    <div><img src="{{ asset('views/imgs/cardapioSobremesas.jpg') }}" class="img-responsive img-rounded"/></div>
                    <div class="col-xs-12 text-center itemBotao">
                        <a href="auth/register" class="btn btn-default btn-lg">Sobremesas</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="itemMenu">
                    <div><img src="{{ asset('views/imgs/cardapioBebidas.jpg') }}" class="img-responsive img-rounded"/></div>
                    <div class="col-xs-12 text-center itemBotao">
                        <a href="auth/register" class="btn btn-default btn-lg">Bebidas</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

        </div>
    </div>
</section>
<!-- // Menu -->



<!-- Quem Somos -->
<section id="quemsomos">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header"><h1>Quem Somos <small>Conheça nossa história!</small></h1></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="col-sm-8 text-right">
                    <h3>Sobre Os PrintF Pizzaria:</h3>
                    <p>Fundada no Brasil em 2010, Os PrintF Pizzaria é uma das maiores redes de pizzaria delivery do mundo. A marca PrintF está baseada em cinco pilares que norteiam o posicionamento da marca no Brasil e no mundo: sabor, preço, velocidade, delivery e promoção. Isto quer dizer que, mesmo sendo uma marca conhecida mundialmente, Os PrintF sabe da importância de agir localmente, de acordo com a particularidade de cada lugar.
                    </p>
                </div>
                <div class="col-sm-4">
                    <img src="{{ asset('views/imgs/pizzaria.png') }}" class="img-responsive img-circle"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-sm-4">
                    <img src="{{ asset('views/imgs/missaoPizza.jpg') }}" class="img-responsive img-circle"/>
                </div>
                <div class="col-sm-8 text-left">
                    <h3>Missão da empresa:</h3>
                    <p>Os PrintF Pizzaria, tem como proposta oferecer um programa completo: ambiente agradável, boa pizza e diversas opções. <br/>
                        A qualidade e o sabor dos pratos servidos, principalmente de nossas pizzas, bem como o atendimento de nossa equipe, é, sem duvida, o nosso maior orgulho, e a razão de uma clientela amiga e cativa, que nos acompanha por todos esses anos.<br>
                        <b> Os PrintF Pizzaria - Sabores que marcam para sempre!</b></p>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="page-header"><h1>Nossa Equipe <small>Conheça nossos colaboradores!</small></h1></div>
            </div>
        </div>

        <div class="row itemEmpresa">
            <div class="col-sm-3">
                <div>
                    <div><img src="{{ asset('views/imgs/bootstrap.png') }}" class="img-responsive grayscale img-rounded"/></div>
                    <h4>Bootstrap</h4>
                </div>
            </div>
            <div class="col-sm-3">
                <div>
                    <div><img src="{{ asset('views/imgs/laravel.png') }}" class="img-responsive grayscale img-rounded"/></div>
                    <h4>Laravel</h4>
                </div>
            </div>
            <div class="col-sm-3">
                <div>
                    <div><img src="{{ asset('views/imgs/cordova-ng-ionic.png') }}" class="img-responsive grayscale img-rounded"/></div>
                    <h4>Cordova + AngularJS + Ionic</h4>
                </div>
            </div>
            <div class="col-sm-3">
                <div>
                    <div><img src="{{ asset('views/imgs/julio.jpg') }}" class="img-responsive grayscale img-rounded"/></div>
                    <h4>Júlio Nery</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 text-center">
            </div>
        </div>
    </div>
</section>
<!-- // Quem Somos -->



<!-- Localização -->
<section id="localizacao" class="divcolorida">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header"><h1>Localização <small>Veja onde estamos!</small></h1></div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60782.00891725883!2d-50.96180805590793!3d-17.797544710869705!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9361db7d2c321dc1%3A0xe7ac78da77d5dc69!2sRio+Verde%2C+GO!5e0!3m2!1spt-BR!2sbr!4v1446926374839" width="100%" height="520" frameborder="0" style="border:0" allowfullscreen></iframe>

            </div>
        </div>
    </div>
</section>
<!-- // Localização -->



<!-- Contato -->
<section id="contato">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-header"><h1>Contato <small>Fale conosco agora mesmo!</small></h1></div>
            </div>
        </div>

        <div class="row contato">
            <div class="col-xs-12">
                <p class="bg-info aviso">Preencha o formulário para entrar em contato conosco!</p>
            </div>
        </div>


        <div class="row contato">
            <div class="col-xs-12">
                {!! Form::open(['route'=>'mail.store']) !!}

                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::text('nome', null, ['class'=>'form-control input-lg', 'required', 'placeholder' => 'Qual o seu nome? *']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('email', null, ['class'=>'form-control input-lg', 'required', 'placeholder' => 'Qual o seu email? *']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::text('telefone', null, ['class'=>'form-control input-lg input-mask', 'required', 'data-mask'=>'(00) 00000-0000', 'placeholder' => 'Seu telefone? *']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            {!! Form::textarea('mensagem', null, ['class'=>'form-control input-lg input-mask', 'required', 'placeholder' => 'Sua mensagem! *']) !!}

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">

                        @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="alert">
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                            @if(Session::has('message'))
                                <div class="alert alert-success">
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        @endif
                        </div>

                        <div class="col-sm-6 text-right">
                            {!! Form::submit('Enviar Formulário', ['class' => 'btn btn-info btn-lg']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<!-- // Contato -->

@endsection