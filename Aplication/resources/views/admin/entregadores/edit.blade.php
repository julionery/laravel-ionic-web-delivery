@extends('layout')

@section('content')

    <h2>Editando Funcionário: <font color="#1e90ff">{{$entregador->usuario->nome}} </font></h2>

    @include('errors._check')

    <div class="panel panel-default">
        {!! Form::model($entregador, ['route'=>['admin.entregadores.update', $entregador->id]]) !!}
    </div>
    <div class="card">
        <div class="card-body card-padding">
            <div class="row" style="padding: 20px 20px 20px 20px">
                @include('admin.entregadores._form')

                <div class="col-sm-2">
                    <div class="form-group">
                        <div class="fg-line">
                            {!! Form::label('Resetar senha?') !!}
                            {!! Form::select('senha', array('nao'=> 'Não', 'Sim'=> 'Sim'), null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <br><br><br>
                <div class="col-sm-12">
                    <div class="panel panel-default">
                        {!! Form::submit('Salvar Funcionário', ['class'=> 'btn btn-primary']) !!}
                        <a href="{{ route('admin.entregadores.index') }}" class="btn btn-primary" style="width: 100px">Voltar</a>
                    </div>
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

