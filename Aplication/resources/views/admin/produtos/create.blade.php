@extends('layout')

@section('content')

    <h2>Novo Produto</h2>

    @include('errors._check')

    <div class="panel panel-default">
        {!! Form::open(['route'=>'admin.produtos.store']) !!}
    </div>
    <div class="card">
        <div class="card-body card-padding">
            <div class="row" style="padding: 0px 20px 0px 20px">
                @include('admin.produtos._form')
                <div class="col-sm-8">
                    <div class="form-group">
                        {!! Form::label('Componentes / Ingredientes:') !!}
                        {!!Form::select('ingredientes[]', $data, null,['mutiple', 'id' => 'js-example-tokenizer', 'multiple' => 'multiple', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                {!! Form::submit('Criar Produto', ['class'=> 'btn btn-primary']) !!}
                <a href="{{ route('admin.produtos.index') }}" class="btn btn-primary" style="width: 100px">Voltar</a>
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

<script>
    $("#js-example-tokenizer").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
</script>

@endpush