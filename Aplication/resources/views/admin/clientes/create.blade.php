@extends('layout')

@section('content')

    <h2>Novo Cliente</h2>

    @include('errors._check')

    <div class="panel panel-default">
        {!! Form::open(['route'=>'admin.clientes.store']) !!}
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
                                {!! Form::email('usuario[email]', null, ['class'=>'form-control', 'required']) !!}
                            </div>
                        </div>
                    </div>
                @include('admin.clientes._form')

                <br><br><br>
                <div class="panel panel-default">
                    {!! Form::submit('Criar Cliente', ['class'=> 'btn btn-primary']) !!}
                    <a href="{{ route('admin.clientes.index') }}" class="btn btn-primary"
                       style="width: 100px">Voltar</a>
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
