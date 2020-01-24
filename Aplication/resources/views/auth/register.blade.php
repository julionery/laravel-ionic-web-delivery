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
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="text-center m-t-25 p-t-15 block-header-alt">
                    <center>
                        <h1>REGISTRAR</h1>
                    </center>
                </div>
                <div class="panel-body">
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/clientes/criarNovoUsuario') }}">
                        {!! csrf_field() !!}
                        <div class="form-group" style="margin-top: 20px">
                            <div class="col-md-6 col-md-offset-1">
                                <div class="fg-line">
                                    {!! Form::label('Nome: *') !!}
                                    {!! Form::text('nome', null, ['class'=>'form-control',  'autofocus', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fg-line">
                                    {!! Form::label('Password', 'Senha: *') !!}
                                    {!! Form::password('senha', ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-1">
                                <div class="fg-line">
                                    {!! Form::label('Email: *') !!}
                                    {!! Form::email('email', null, ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="fg-line">
                                    {!! Form::label('Password_confirmation', 'Confirme a senha: *') !!}
                                    {!! Form::password('senha_confirmation',  ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-md-3 col-md-offset-1">
                                <div class="fg-line">
                                    {!! Form::label('CEP: *') !!} <span><a class="btn-link" href="http://www.buscacep.correios.com.br/sistemas/buscacep/buscaCepEndereco.cfm" target="_blank"> Não sabe seu CEP?</a></span>

                                    {!! Form::text('cep', null, ['class'=>'form-control input-mask', 'data-mask'=>'00000-000', 'placeholder'=>'00000-000', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="fg-line">
                                    {!! Form::label('Endereço: *') !!}
                                    {!! Form::text('endereco', null, ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="fg-line">
                                    {!! Form::label('N°: *') !!}
                                    {!! Form::text('numero', null, ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="fg-line">
                                    {!! Form::label('Qd: *') !!}
                                    {!! Form::text('quadra', null, ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="fg-line">
                                    {!! Form::label('Lt: *') !!}
                                    {!! Form::text('lote', null, ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-2 col-md-offset-1">
                                    <div class="fg-line">
                                        {!! Form::label('Sexo: ') !!}
                                        {!! Form::select('sexo', array('F'=> 'Feminino', 'M'=> 'Masculino', 'O' => 'Outro'), null, ['class'=>'form-control']) !!}
                                    </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="fg-line">
                                    {!! Form::label('Telefone: *') !!}
                                    {!! Form::text('telefone', null, ['class'=>'form-control input-mask', 'data-mask'=>'(00) 00000-0000', 'placeholder'=>'(00) 00000-0000', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="fg-line">
                                    {!! Form::label('Bairro: *') !!}
                                    {!! Form::text('bairro', null, ['class'=>'form-control', 'required']) !!}
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="fg-line">
                                    {!! Form::label('Cidade: ') !!}
                                    {!! Form::text('cidade', null, ['class'=>'form-control']) !!}
                                </div>
                            </div>


                            <div class="col-sm-2">
                                <div class="fg-line">
                                    {!! Form::label('Estado: ') !!}
                                    {!! Form::text('estado', null, ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 20px">
                            <div class="col-md-4 col-md-offset-2">
                                <button type="submit" class="col-xs-12 btn btn-primary">
                                    Salvar
                                </button>
                                <br><br>
                            </div>
                            <div class="col-md-4">
                                    <a class="col-xs-12 btn btn-primary"  onclick="history.go(-1);">Voltar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Javascript Libraries -->
{!!  Html::script('design/vendors/bower_components/jquery/dist/jquery.min.js') !!}
{!!  Html::script('design/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') !!}

{!!  Html::script('design/vendors/bower_components/Waves/dist/waves.min.js') !!}

<!-- Placeholder for IE9 -->
<!--[if IE 9 ]>
{!!  Html::script('design/vendors/bower_components/jquery-placeholder/jquery.placeholder.min.js') !!}
<![endif]-->

<!-- Scripts -->
{!!  Html::script('design/vendors/chosen_v1.4.2/chosen.jquery.min.js') !!}
{!!  Html::script('design/vendors/fileinput/fileinput.min.js') !!}
{!!  Html::script('design/vendors/input-mask/input-mask.min.js') !!}
{!!  Html::script('design/vendors/farbtastic/farbtastic.min.js') !!}

</body>
</html>

