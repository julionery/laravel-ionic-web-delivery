@extends('layout')

@section('content')

    <h2>Editando Ingrediente: <font color="#1e90ff">{{$componente->nome}} </font></h2>

    @include('errors._check')

    <div class="panel panel-default">
        {!! Form::model($componente, ['route'=>['admin.ingredientes.update', $componente->id]]) !!}
    </div>
    <div class="card">
        <div class="card-body card-padding">
            <div class="row" style="padding: 20px 20px 20px 20px">
                @include('admin.ingredientes._form')

                <br><br><br>
                <div class="panel panel-default">
                    {!! Form::submit('Salvar Ingrediente', ['class'=> 'btn btn-primary']) !!}
                    <a href="{{ route('admin.ingredientes.index') }}" class="btn btn-primary"
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

