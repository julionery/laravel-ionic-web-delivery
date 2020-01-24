@extends('layout')

@section('content')

    <h2>Perfil: <font color="#1e90ff">{{$cliente->usuario->nome}} </font></h2>

    @include('errors._check')

    <div class="panel panel-default">
        {!! Form::model($cliente, ['route'=>['customer.perfil.update', $cliente->id]]) !!}
    </div>
    <div class="card">
        <div class="card-body card-padding">
            <div class="row" style="padding: 20px 20px 20px 20px">
                <div class="row">
                    <p>Campos com <font color="red">*</font> são obrigatórios!</p>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="fg-line">
                                {!! Form::label('Nome: *') !!}
                                {!! Form::text('usuario[nome]', null, ['class'=>'form-control',  'autofocus', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div class="fg-line">
                                {!! Form::label('Email: *') !!}
                                {!! Form::email('usuario[email]', null, ['class'=>'form-control', 'disabled' => 'disabled', 'required']) !!}
                            </div>
                        </div>
                    </div>
                @include('admin.clientes._form')
                <div class="col-md-12">
                    <div class="col-md-4">
                        <div class="fg-line">
                            {!! Form::label('Password', 'Senha: ') !!}
                            {!! Form::password('senha', ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="fg-line">
                            {!! Form::label('Password_confirmation', 'Confirme a senha: ') !!}
                            {!! Form::password('senha_confirmation',  ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        <br><br>
                        {!! Form::submit('Salvar', ['class'=> 'btn btn-primary']) !!}
                        <a href="/home" class="btn btn-primary"
                           style="width: 100px">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {!! Form::close() !!}

@stop

@push('scripts')
{!!  Html::script('design/vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}

{!!  Html::script('design/vendors/chosen_v1.4.2/chosen.jquery.min.js') !!}
{!!  Html::script('design/vendors/fileinput/fileinput.min.js') !!}
{!!  Html::script('design/vendors/input-mask/input-mask.min.js') !!}
{!!  Html::script('design/vendors/farbtastic/farbtastic.min.js') !!}

@endpush

