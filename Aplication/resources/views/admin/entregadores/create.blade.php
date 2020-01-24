@extends('layout')

@section('content')

<h2>Novo Funcionário</h2>

@include('errors._check')

<div class="panel panel-default">
{!! Form::open(['route'=>'admin.entregadores.store']) !!}
</div>
<div class="card">
    <div class="card-body card-padding">
        <div class="row" style="padding: 20px 20px 20px 20px">
                @include('admin.entregadores._form')

                @if(Auth::user()->tipo == "desenvolvedor")
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('Empresa','Empresa: *') !!}
                            <div class="dropdown">
                                {!! Form::select('empresa_id', $empresas, null, ['class'=>'dropdown-toggle btn btn-default']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <br><br><br>
                <div class="panel panel-default">
                    {!! Form::submit('Criar Funcionário', ['class'=> 'btn btn-primary']) !!}
                    <a href="{{ route('admin.entregadores.index') }}" class="btn btn-primary" style="width: 100px">Voltar</a>
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