@extends('layout')

@section('content')

    <h2>Clonando o Produto: <font color="#1e90ff">{{$produtos->nome}} </font></h2>

    @include('errors._check')

    <div class="panel panel-default">
        {!! Form::model($produtos, ['route'=> 'admin.produtos.storeClone']) !!}
    </div>
    <div class="card">
        <div class="card-body card-padding">
            <div class="row" style="padding: 20px 20px 20px 20px">
                @include('admin.produtos._form')

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <div class="fg-line">
                                {!! Form::label('Componentes / Ingredientes:') !!}
                                {!! Form::text('componentes', $produtos->ComponenteList, ['class'=> 'form-control', 'data-trigger'=>'hover', 'data-toggle'=> 'popover', 'data-placement'=>'bottom', 'data-content'=>'Digite os ingredientes separados por vírgula. Novos valores serão acrescentados automaticamente a tabela de ingredientes.', 'title'=>'', 'data-original-title'=>'Ingredientes']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <br><br><br>
                <div class="panel panel-default">
                    {!! Form::submit('Salvar Produto', ['class'=> 'btn btn-primary']) !!}
                    <a href="{{ route('admin.produtos.index') }}" class="btn btn-primary"
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

